<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Word;
use App\Models\WordExample;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

final class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): Response
    {
        if ($request->hasQuery()) {
            $word = Word::whereText($request->getQuery())->whereLang(Word::LANGUAGE_EN)->first();

            if (! $word instanceof Word) {
                return Inertia::render('Search', ['query' => $request->getQuery()])
                    ->with('alert', [
                        'type' => 'error',
                        'message' => 'Ошибка! В словаре не существует такого слова.',
                    ]);
            }

            $translation = DB::table('translations as t')
                ->select(['w.id', 'w.text'])
                ->join('words as w', function ($join) {
                    $join->on('w.id', '=', 't.word_id1')
                        ->orOn('w.id', '=', 't.word_id2');
                })
                ->where('w.lang', '=', $request->getLang())
                ->where(function ($query) use ($word) {
                    $query->where('t.word_id1', '=', $word->id)
                        ->orWhere('t.word_id2', '=', $word->id);
                })
                ->first();

            if ($translation === null) {
                return Inertia::render('Search', ['query' => $request->getQuery()])
                    ->with('alert', [
                        'type' => 'error',
                        'message' => 'Ошибка! В словаре не существует перевода для этого слова.',
                    ]);
            }

            return Inertia::render('Search', [
                'query' => $request->getQuery(),
                'translation' => $translation->text,
                'examples' => WordExample::whereWordId($translation->id)->get(['original', 'translation']),
            ]);
        }

        return Inertia::render('Search');
    }
}
