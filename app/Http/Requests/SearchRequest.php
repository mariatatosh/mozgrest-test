<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Word;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class SearchRequest extends FormRequest
{
    public function getLang(): string
    {
        return $this->route('lang');
    }

    public function getQuery(): ?string
    {
        return $this->get('q');
    }

    public function hasQuery(): bool
    {
        return $this->has('q');
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['lang' => $this->getLang()]);
    }

    public function rules(): array
    {
        return [
            'q' => 'nullable|string',
            'lang' => [
                'required',
                Rule::in([Word::LANGUAGE_RU, Word::LANGUAGE_ES]),
            ],
        ];
    }
}
