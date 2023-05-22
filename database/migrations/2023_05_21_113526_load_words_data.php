<?php

declare(strict_types=1);

use App\Models\Topic;
use App\Models\Translation;
use App\Models\Word;
use App\Models\WordExample;
use Illuminate\Database\Migrations\Migration;
use App\Services\OxfordDictionary\OxfordDictionaryClient;

return new class extends Migration {
    public function up(): void
    {
        $topics = [
            'food'   => ['banana', 'bread', 'egg', 'fish'],
            'family' => ['mother', 'brother', 'daughter', 'boyfriend'],
        ];

        $dictionaryClient = app(OxfordDictionaryClient::class);
        $dictionaryClient->setSourceLang(Word::LANGUAGE_EN);

        foreach ($topics as $topic => $words) {
            $topic = Topic::create(['name' => $topic]);

            foreach ($words as $word) {
                $enWord = Word::create(['topic_id' => $topic->id, 'text' => $word, 'lang' => Word::LANGUAGE_EN]);

                $ruTranslation = $dictionaryClient->setTargetLang(Word::LANGUAGE_RU)->translate($word);
                $ruWord        = Word::create([
                    'topic_id' => $topic->id,
                    'text'     => $ruTranslation->getTranslation(),
                    'lang'     => Word::LANGUAGE_RU,
                ]);

                Translation::create(['word_id1' => $enWord->id, 'word_id2' => $ruWord->id]);

                foreach ($ruTranslation->getExamples() as $example) {
                    WordExample::create([
                        'word_id'     => $ruWord->id,
                        'original'    => $example['original'],
                        'translation' => $example['translation']
                    ]);
                }

                $esTranslation = $dictionaryClient->setTargetLang(Word::LANGUAGE_ES)->translate($word);
                $esWord        = Word::create([
                    'topic_id' => $topic->id,
                    'text'     => $esTranslation->getTranslation(),
                    'lang'     => Word::LANGUAGE_ES,
                ]);

                Translation::create(['word_id1' => $enWord->id, 'word_id2' => $esWord->id]);
                Translation::create(['word_id1' => $ruWord->id, 'word_id2' => $esWord->id]);

                foreach ($esTranslation->getExamples() as $example) {
                    WordExample::create([
                        'word_id'     => $esWord->id,
                        'original'    => $example['original'],
                        'translation' => $example['translation']
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Word::truncate();
        Topic::truncate();
    }
};
