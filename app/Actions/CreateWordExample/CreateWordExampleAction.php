<?php

declare(strict_types=1);

namespace App\Actions\CreateWordExample;

use App\Models\WordExample;

final class CreateWordExampleAction
{
    public function handle(CreateWordExampleInput $input): WordExample
    {
        return WordExample::create([
            'word_id' => $input->getWordId(),
            'original' => $input->getOriginal(),
            'translation' => $input->getTranslation(),
        ]);
    }
}
