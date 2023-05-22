<?php

declare(strict_types=1);

namespace App\Services\OxfordDictionary;

final class TranslationParser
{
    /**
     * @param array $content
     */
    public function __construct(private readonly array $content)
    {
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->retrieveSenses()[0]->translations[0]->text;
    }

    /**
     * @return array
     */
    public function getExamples(): array
    {
        $senses = $this->retrieveSenses();

        if (empty($senses[1]) || empty($senses[1]->examples)) {
            return [];
        }

        $examples = array_slice($senses[1]->examples, 0, 3);

        return array_map(static function ($example) {
            return [
                'original'    => $example->text,
                'translation' => $example->translations[0]->text,
            ];
        }, $examples);
    }

    /**
     * @return array
     */
    private function retrieveSenses(): array
    {
        return $this->content[0]->lexicalEntries[0]->entries[0]->senses;
    }
}
