<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WordSentence
 *
 * @property int $id
 * @property int $word_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence query()
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordSentence whereWordId($value)
 * @mixin \Eloquent
 */
final class WordSentence extends Model
{
    use HasFactory;
}
