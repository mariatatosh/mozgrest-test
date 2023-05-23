<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;

final class TopicAlreadyExists extends DomainException
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('Topic "%s" already exists', $name));
    }
}
