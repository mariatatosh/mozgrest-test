<?php

declare(strict_types=1);

namespace App\Actions\CreateWord;

final class CreateWordInput
{
    public function __construct(
        private readonly int $topicId,
        private readonly string $text,
        private readonly string $lang
    ) {
    }

    public function getTopicId(): int
    {
        return $this->topicId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getLang(): string
    {
        return $this->lang;
    }
}
