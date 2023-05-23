<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateWordExample\CreateWordExampleAction;
use App\Actions\CreateWordExample\CreateWordExampleInput;
use App\Models\Topic;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

final class CreateWordExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_success(): void
    {
        $topic = Topic::factory()->create(['name' => 'topic-1']);
        $word = Word::factory()->create(['topic_id' => $topic->id, 'text' => 'word-1', 'lang' => Word::LANGUAGE_EN]);

        $example = (new CreateWordExampleAction())->handle(
            new CreateWordExampleInput(
                $word->id,
                $originalText = 'original',
                $translationText = 'translation'
            )
        );

        $this->assertEquals($word->id, $example->word_id);
        $this->assertEquals(ucfirst($originalText), $example->original);
        $this->assertEquals(ucfirst($translationText), $example->translation);

        $this->assertDatabaseHas('word_examples', [
            'word_id' => $word->id,
            'original' => $originalText,
            'translation' => $translationText,
        ]);
    }

    public function test_empty_args(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new CreateWordExampleAction())->handle(
            new CreateWordExampleInput(0, '', 'translation')
        );

        $this->expectException(InvalidArgumentException::class);

        (new CreateWordExampleAction())->handle(
            new CreateWordExampleInput(0, 'original', '')
        );
    }
}
