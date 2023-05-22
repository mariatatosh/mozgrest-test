<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translation
 *
 * @property int $word_id1
 * @property int $word_id2
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereWordId1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereWordId2($value)
 *
 * @mixin \Eloquent
 */
final class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['word_id1', 'word_id2'];

    public $timestamps = false;
}
