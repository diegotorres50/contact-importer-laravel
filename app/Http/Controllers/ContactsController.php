<?php

namespace App\Http\Controllers;

use App\Imports\ContactsImport;
use App\Models\CsvFile;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \Auth::user();
        return view('contacts.list')
            ->with('contacts', $user->contacts()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:txt,csv'
        ]);
        $file = $request->file('csvFile');
        $fileName = $file->getClientOriginalName();
        $destinationFolder = 'csv/' . $request->user()->id;
        $destination = $file->storePubliclyAs(
            'public/' . $destinationFolder,
            $fileName
        );
        $importedBy = $request->user();
        $csvFileUploaded = $importedBy->files()->create([
            'name' => $fileName,
            'url' => asset('storage/' . $destinationFolder . '/' . $fileName),
            'path' => $destination,
        ]);
        \Excel::import(new ContactsImport($importedBy, $csvFileUploaded), $file);
        $csvFileUploaded->refresh();
        if ($csvFileUploaded->status === CsvFile::STATUS_WAITING) {
            $csvFileUploaded->status = CsvFile::STATUS_FINISHED;
            $csvFileUploaded->save();
        }
        return redirect()->route('home')
            ->with('uploading', true);
    }

    public function history()
    {
        $user = \Auth::user();
        return view('contacts.files')
            ->with('files', $user->files()->paginate(5));
    }

    public function errors()
    {
        $user = \Auth::user();
        return view('contacts.errors')
            ->with('exceptions', $user->importFileErrors()->paginate(5));
    }
}
