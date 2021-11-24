<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CsvFile
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $path
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereUserId($value)
 * @mixin \Eloquent
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|CsvFile whereStatus($value)
 */
class CsvFile extends Model
{
    use HasFactory;

    const STATUS_WAITING = 'waiting';
    const STATUS_PROCESSING = 'processing';
    const STATUS_FAILED = 'failed';
    const STATUS_FINISHED = 'finished';

    protected $table = 'csv_files';

    protected $attributes = [
        'status' => self::STATUS_WAITING,
    ];

    protected $fillable = [
        'user_id',
        'name',
        'url',
        'path',
        'status',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
