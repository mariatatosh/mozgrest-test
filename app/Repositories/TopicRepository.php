<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Topic;

final class TopicRepository
{
    public function exists(string $name): bool
    {
        return Topic::whereName($name)->exists();
    }
}
