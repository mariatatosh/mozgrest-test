<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;
use Inertia\Response;

final class DictionaryController extends Controller
{
    public function __invoke(string $lang): Response
    {
        $topics = Topic::with('words')->get();

        $wordGroups = $topics
            ->map(fn (Topic $topic) => $topic->words->where('lang', $lang)->pluck('text'))
            ->toArray();

        return Inertia::render('Dictionary', [
            'topics' => $topics->pluck('name'),
            'wordGroups' => ! empty($wordGroups) ? array_map(null, ...$wordGroups) : [],
        ]);
    }
}
