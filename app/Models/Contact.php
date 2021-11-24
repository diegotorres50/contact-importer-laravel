<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactsController
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $dateOfBirth
 * @property string $phone
 * @property string $address
 * @property string $creditCard
 * @property string $franchise
 * @property string $email
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreditCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFranchise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @mixin \Eloquent
 * @property-read string $masked_credit_card
 * @method static \Database\Factories\ContactFactory factory(...$parameters)
 */
class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'dateOfBirth',
        'phone',
        'address',
        'creditCard',
        'franchise',
        'email',
        'user_id'
    ];

    protected $casts = [
        'dateOfBirth' => 'date'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMaskedCreditCardAttribute(): string
    {
        return \Str::mask($this->creditCard, '*', 0, strlen($this->creditCard) - 4);
    }
}
