<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WordExample
 *
 * @property int $id
 * @property int $word_id
 * @property string $original
 * @property string $translation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample query()
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereTranslation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordExample whereWordId($value)
 * @mixin \Eloquent
 */
final class WordExample extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_id',
        'original',
        'translation',
    ];
}
