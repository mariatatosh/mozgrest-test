<?php

declare(strict_types=1);

namespace App\Actions\CreateWordExample;

final class CreateWordExampleInput
{
    public function __construct(
        private readonly int $wordId,
        private readonly string $original,
        private readonly string $translation
    ) {
    }

    public function getWordId(): int
    {
        return $this->wordId;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getTranslation(): string
    {
        return $this->translation;
    }
}
