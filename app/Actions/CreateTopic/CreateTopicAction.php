<?php

declare(strict_types=1);

namespace App\Actions\CreateTopic;

use App\Exceptions\TopicAlreadyExists;
use App\Models\Topic;
use App\Repositories\TopicRepository;
use Webmozart\Assert\Assert;

final class CreateTopicAction
{
    public function __construct(private readonly TopicRepository $topics)
    {
    }

    public function handle(CreateTopicInput $input): Topic
    {
        Assert::stringNotEmpty($input->getName());

        if ($this->topics->exists($input->getName())) {
            throw new TopicAlreadyExists($input->getName());
        }

        return Topic::create(['name' => $input->getName()]);
    }
}
