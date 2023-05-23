<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateWord\CreateWordAction;
use App\Actions\CreateWord\CreateWordInput;
use App\Models\Topic;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

final class CreateWordTest extends TestCase
{
    use RefreshDatabase;

    public function test_success(): void
    {
        $topic = Topic::factory()->create(['name' => 'topic-1']);

        $word = (new CreateWordAction())->handle(
            new CreateWordInput($topic->id, $wordText = 'word-1', $lang = Word::LANGUAGE_EN)
        );

        $this->assertEquals($topic->id, $word->topic_id);
        $this->assertEquals(ucfirst($wordText), $word->text);
        $this->assertEquals($lang, $word->lang);

        $this->assertDatabaseHas('words', [
            'topic_id' => $topic->id,
            'text' => $wordText,
            'lang' => $lang,
        ]);
    }

    public function test_empty_text(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new CreateWordAction())->handle(
            new CreateWordInput(0, '', Word::LANGUAGE_EN)
        );
    }
}
