<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Support\Facades\DB;

final class TranslationRepository
{
    public function findByWordIdAndLang(int $wordId, string $lang): ?Word
    {
        $id = DB::table('translations as t')
            ->select('w.id')
            ->join('words as w', function ($join) {
                $join->on('w.id', '=', 't.word_id1')
                    ->orOn('w.id', '=', 't.word_id2');
            })
            ->where('w.lang', '=', $lang)
            ->where(function ($query) use ($wordId) {
                $query->where('t.word_id1', '=', $wordId)
                    ->orWhere('t.word_id2', '=', $wordId);
            })
            ->value('id');

        return Word::find($id);
    }
}
