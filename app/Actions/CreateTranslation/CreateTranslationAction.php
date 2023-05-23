<?php

declare(strict_types=1);

namespace App\Actions\CreateTranslation;

use App\Exceptions\TranslationAlreadyExists;
use App\Models\Translation;
use App\Repositories\TranslationRepository;

final class CreateTranslationAction
{
    public function __construct(private readonly TranslationRepository $translations)
    {
    }

    public function handle(CreateTranslationInput $input): Translation
    {
        if ($this->translations->exists($input->getWordId1(), $input->getWordId2())) {
            throw new TranslationAlreadyExists($input->getWordId1(), $input->getWordId2());
        }

        return Translation::create(['word_id1' => $input->getWordId1(), 'word_id2' => $input->getWordId2()]);
    }
}
