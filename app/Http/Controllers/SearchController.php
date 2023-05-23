<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Word;
use App\Repositories\TranslationRepository;
use Inertia\Inertia;
use Inertia\Response;

final class SearchController extends Controller
{
    public function __construct(private readonly TranslationRepository $translations)
    {
    }

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

            $translation = $this->translations->findByWordIdAndLang($word->id, $request->getLang());

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
                'examples' => $translation->examples()->get(['original', 'translation']),
            ]);
        }

        return Inertia::render('Search');
    }
}
