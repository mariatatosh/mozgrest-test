<?php

declare(strict_types=1);

namespace App\Actions\CreateTranslation;

final class CreateTranslationInput
{
    public function __construct(private readonly int $wordId1, private readonly int $wordId2)
    {
    }

    /**
     * @return int
     */
    public function getWordId1(): int
    {
        return $this->wordId1;
    }

    /**
     * @return int
     */
    public function getWordId2(): int
    {
        return $this->wordId2;
    }
}
