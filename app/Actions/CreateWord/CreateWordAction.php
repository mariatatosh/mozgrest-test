<?php

declare(strict_types=1);

namespace App\Actions\CreateWord;

final class CreateWordAction
{
    public function handle(CreateWordInput $input): Word
    {
        return Word::create([
            'topic_id' => $input->getTopicId(),
            'text' => $input->getText(),
            'lang' => $input->getLang(),
        ]);
    }
}
