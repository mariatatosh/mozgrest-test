<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;

final class TranslationAlreadyExists extends DomainException
{
    public function __construct(int $wordId1, int $wordId2)
    {
        parent::__construct(sprintf('Translation for words "%d" and "%d" already exists', $wordId1, $wordId2));
    }
}
