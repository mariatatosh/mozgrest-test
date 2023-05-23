<?php

declare(strict_types=1);

namespace App\Actions\CreateWord;

use App\Models\Word;
use Webmozart\Assert\Assert;

final class CreateWordAction
{
    public function handle(CreateWordInput $input): Word
    {
        Assert::stringNotEmpty($input->getText());
        Assert::inArray($input->getLang(), [Word::LANGUAGE_EN, Word::LANGUAGE_RU, Word::LANGUAGE_ES]);

        return Word::create([
            'topic_id' => $input->getTopicId(),
            'text' => $input->getText(),
            'lang' => $input->getLang(),
        ]);
    }
}
