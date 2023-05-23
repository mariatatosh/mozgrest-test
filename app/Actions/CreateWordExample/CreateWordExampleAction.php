<?php

declare(strict_types=1);

namespace App\Actions\CreateWordExample;

use App\Models\WordExample;
use Webmozart\Assert\Assert;

final class CreateWordExampleAction
{
    public function handle(CreateWordExampleInput $input): WordExample
    {
        Assert::stringNotEmpty($input->getOriginal());
        Assert::stringNotEmpty($input->getTranslation());

        return WordExample::create([
            'word_id' => $input->getWordId(),
            'original' => $input->getOriginal(),
            'translation' => $input->getTranslation(),
        ]);
    }
}
