<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateTranslation\CreateTranslationAction;
use App\Actions\CreateTranslation\CreateTranslationInput;
use App\Exceptions\TranslationAlreadyExists;
use App\Models\Topic;
use App\Models\Word;
use App\Repositories\TranslationRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CreateTranslationTest extends TestCase
{
    use RefreshDatabase;

    public function test_success(): void
    {
        $topic = Topic::factory()->create(['name' => 'topic-1']);
        $word1 = Word::factory()->create(['topic_id' => $topic->id, 'text' => 'word-1', 'lang' => Word::LANGUAGE_EN]);
        $word2 = Word::factory()->create(['topic_id' => $topic->id, 'text' => 'word-2', 'lang' => Word::LANGUAGE_RU]);

        $translations = $this->mock(TranslationRepository::class);
        $translations->shouldReceive('exists')
            ->once()
            ->with($word1->id, $word2->id)
            ->andReturn(false);

        $action = new CreateTranslationAction($translations);
        $translation = $action->handle(new CreateTranslationInput($word1->id, $word2->id));

        $this->assertEquals($word1->id, $translation->word_id1);
        $this->assertEquals($word2->id, $translation->word_id2);

        $this->assertDatabaseHas('translations', [
            'word_id1' => $word1->id,
            'word_id2' => $word2->id,
        ]);
    }

    public function test_already_exists(): void
    {
        $topic = Topic::factory()->create(['name' => 'topic-1']);
        $word1 = Word::factory()->create(['topic_id' => $topic->id, 'text' => 'word-1', 'lang' => Word::LANGUAGE_EN]);
        $word2 = Word::factory()->create(['topic_id' => $topic->id, 'text' => 'word-2', 'lang' => Word::LANGUAGE_RU]);

        $translations = $this->mock(TranslationRepository::class);
        $translations->shouldReceive('exists')
            ->once()
            ->with($word1->id, $word2->id)
            ->andReturn(true);

        $this->expectException(TranslationAlreadyExists::class);

        $action = new CreateTranslationAction($translations);
        $action->handle(new CreateTranslationInput($word1->id, $word2->id));

        $this->assertDatabaseMissing('translations', [
            'word_id1' => $word1->id,
            'word_id2' => $word2->id,
        ]);
    }
}
