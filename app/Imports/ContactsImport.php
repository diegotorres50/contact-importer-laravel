<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\CsvFile;
use App\Models\ImportFileErrors;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jlorente\CreditCards\CreditCardValidator;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ContactsImport implements ToModel, WithCustomCsvSettings, WithHeadingRow, WithValidation, SkipsOnFailure, ShouldQueue, WithChunkReading, WithUpserts
{

    private $importedBy;
    /**
     * @var CreditCardValidator
     */
    private $validator;
    /**
     * @var CsvFile
     */
    private $fileUploaded;

    public function __construct(User $importedBy, CsvFile $fileUploaded)
    {
        $this->importedBy = $importedBy;
        $this->validator = new CreditCardValidator();
        $this->fileUploaded = $fileUploaded;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $franchise = $this->validator->getType($row['credit_card']);
        return new Contact([
            'name' => $row['names'],
            'dateOfBirth' => $row['date_of_birth'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'creditCard' => $row['credit_card'],
            'franchise' => $franchise->getNiceType(),
            'email' => $row['email'],
            'user_id' => $this->importedBy->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'names' => 'required|string|regex:/^[a-z\s\-]*$/i',
            'date_of_birth' => 'required|date',
            'phone' => 'required|regex:/^(\(\+\d{2}\))\s\d{3}?[\s-]\d{3}?[\s-]\d{2}?[\s-]\d{2}$/',
            'address' => 'required',
            'credit_card' => [
                'required',
                function ($attr, $value, $onFailure) {
                    if (!$this->validator->isValid($value)) {
                        $onFailure('Credit card number is not valid');
                    }
                }
            ],
            'email' => 'required|email',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function onFailure(Failure ...$failures): void
    {
        $this->fileUploaded->update(['status' => CsvFile::STATUS_FAILED]);
        $errors = collect($failures)
            ->map(function ($failure) {
                $row = $failure->values();
                $franchise = $this->validator->getType($row['credit_card']);
                return new ImportFileErrors(([
                    'name' => $row['names'],
                    'date_of_birth' => $row['date_of_birth'],
                    'phone' => $row['phone'],
                    'address' => $row['address'],
                    'credit_card' => $row['credit_card'],
                    'franchise' => $franchise ? $franchise->getNiceType() : null,
                    'email' => $row['email'],
                    'user_id' => $this->importedBy->id,
                    'errors' => $failure->errors()
                ]));
            });
        $this->importedBy->importFileErrors()->saveMany($errors);
    }

    public function uniqueBy()
    {
        return [
            'email',
            'user_id'
        ];
    }
}
