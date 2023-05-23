<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateTopic\CreateTopicAction;
use App\Actions\CreateTopic\CreateTopicInput;
use App\Exceptions\TopicAlreadyExists;
use App\Repositories\TopicRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Mockery\MockInterface;
use Tests\TestCase;

final class CreateTopicTest extends TestCase
{
    use RefreshDatabase;

    public function test_success(): void
    {
        $action = new CreateTopicAction($this->createTopicRepository($topicName = 'topic-1'));
        $topic = $action->handle(new CreateTopicInput($topicName));

        $this->assertEquals($topicName, $topic->name);

        $this->assertDatabaseHas('topics', ['name' => $topicName]);
    }

    public function test_empty_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $action = new CreateTopicAction($this->createTopicRepository($topicName = '', never: true));
        $action->handle(new CreateTopicInput($topicName));

        $this->assertDatabaseMissing('topics', ['name' => $topicName]);
    }

    public function test_already_exists(): void
    {
        $this->expectException(TopicAlreadyExists::class);

        $action = new CreateTopicAction($this->createTopicRepository($topicName = 'topic-1', true));
        $action->handle(new CreateTopicInput($topicName));

        $this->assertDatabaseMissing('topics', ['name' => $topicName]);
    }

    private function createTopicRepository(string $topicName, bool $exists = false, bool $never = false): MockInterface
    {
        $topics = $this->mock(TopicRepository::class);

        if ($never) {
            $topics->shouldReceive('exists')->never();
        } else {
            $topics->shouldReceive('exists')
                ->once()
                ->with($topicName)
                ->andReturn($exists);
        }

        return $topics;
    }
}
