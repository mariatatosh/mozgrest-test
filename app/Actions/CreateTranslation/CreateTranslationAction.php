<?php

declare(strict_types=1);

namespace App\Actions\CreateTranslation;

use App\Models\Translation;

final class CreateTranslationAction
{
    public function handle(CreateTranslationInput $input): Translation
    {
        return Translation::create(['word_id1' => $input->getWordId1(), 'word_id2' => $input->getWordId2()]);
    }
}
