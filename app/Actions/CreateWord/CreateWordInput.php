<?php

declare(strict_types=1);

namespace App\Actions\CreateWord;

final class CreateWordInput
{
    public function __construct(
        private readonly int $topicId,
        private readonly string $text,
        private readonly string $lang
    )
    {
    }

    /**
     * @return int
     */
    public function getTopicId(): int
    {
        return $this->topicId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }
}
