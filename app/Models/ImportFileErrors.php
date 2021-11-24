<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ImportFileErrors
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name
 * @property string|null $date_of_birth
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $credit_card
 * @property string|null $franchise
 * @property string|null $email
 * @property int $user_id
 * @property array|null $errors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereCreditCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereErrors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportFileErrors whereUserId($value)
 */
class ImportFileErrors extends Model
{
    use HasFactory;

    protected $table = 'import_files_errors';
    protected $fillable = [
        'name',
        'date_of_birth',
        'phone',
        'address',
        'credit_card',
        'franchise',
        'email',
        'errors',
        'user_id'
    ];

    protected $casts = [
        'errors' => 'array'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
