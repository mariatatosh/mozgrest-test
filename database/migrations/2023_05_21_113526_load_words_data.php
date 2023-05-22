<?php

declare(strict_types=1);

use App\Actions\CreateTranslation\CreateTranslationAction;
use App\Actions\CreateTranslation\CreateTranslationInput;
use App\Actions\CreateWord\CreateWordAction;
use App\Actions\CreateWord\CreateWordInput;
use App\Actions\CreateWordExample\CreateWordExampleAction;
use App\Actions\CreateWordExample\CreateWordExampleInput;
use App\Models\Topic;
use App\Models\Word;
use App\Services\OxfordDictionary\OxfordDictionaryClient;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $topics = [
            'food' => ['banana', 'bread', 'egg', 'fish'],
            'family' => ['mother', 'brother', 'daughter', 'boyfriend'],
        ];

        foreach ($topics as $topic => $words) {
            $topic = Topic::create(['name' => $topic]);

            foreach ($words as $word) {
                /** @var \App\Models\Word $sourceWord */
                $sourceWord = app(CreateWordAction::class)->handle(
                    new CreateWordInput(
                        $topic->id,
                        $word,
                        Word::LANGUAGE_EN
                    )
                );

                $targetWordRu = $this->createWord($sourceWord, $topic->id, Word::LANGUAGE_RU);
                $targetWordEs = $this->createWord($sourceWord, $topic->id, Word::LANGUAGE_ES);

                $this->createTranslation($targetWordRu->id, $targetWordEs->id);
            }
        }
    }

    public function down(): void
    {
        Word::truncate();
        Topic::truncate();
    }

    private function createWord(Word $sourceWord, int $topicId, string $lang): Word
    {
        $client = app(OxfordDictionaryClient::class)
            ->setSourceLang(Word::LANGUAGE_EN)
            ->setTargetLang($lang);

        $trans = $client->translate($sourceWord->text);

        /** @var \App\Models\Word $targetWord */
        $targetWord = app(CreateWordAction::class)->handle(
            new CreateWordInput(
                $topicId,
                $trans->getTranslation(),
                $lang
            )
        );

        $this->createTranslation($sourceWord->id, $targetWord->id);
        $this->createWordExamples($targetWord->id, $trans->getExamples());

        return $targetWord;
    }

    private function createTranslation(int $wordId1, int $wordId2): void
    {
        app(CreateTranslationAction::class)->handle(
            new CreateTranslationInput($wordId1, $wordId2)
        );
    }

    private function createWordExamples(int $wordId, array $examples): void
    {
        foreach ($examples as $example) {
            app(CreateWordExampleAction::class)->handle(
                new CreateWordExampleInput(
                    $wordId,
                    $example['original'],
                    $example['translation']
                )
            );
        }
    }
};
