<?php

declare(strict_types=1);

namespace App\Services\OxfordDictionary;

use App\Models\Word;
use Psr\Http\Client\ClientInterface;
use Webmozart\Assert\Assert;

final class OxfordDictionaryClient
{
    public const BASE_URI = 'https://od-api.oxforddictionaries.com';

    private const ENDPOINT_TRANSLATIONS = 'translations';

    /** @var string|null */
    private ?string $sourceLang;

    /** @var string|null */
    private ?string $targetLang;

    public function __construct(private readonly ClientInterface $client)
    {
        $this->sourceLang = null;
        $this->targetLang = null;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setSourceLang(string $lang): self
    {
        Assert::eq($lang, Word::LANGUAGE_EN);

        $this->sourceLang = $lang;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setTargetLang(string $lang): self
    {
        Assert::inArray($lang, [Word::LANGUAGE_RU, Word::LANGUAGE_ES]);

        $this->targetLang = $lang;

        return $this;
    }

    /**
     * @param string $word
     *
     * @return \App\Services\OxfordDictionary\TranslationParser
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function translate(string $word): TranslationParser
    {
        Assert::notNull($this->sourceLang);
        Assert::notNull($this->targetLang);

        $response = $this->client->get(
            sprintf(
                'api/v2/%s/%s/%s/%s',
                self::ENDPOINT_TRANSLATIONS,
                $this->sourceLang,
                $this->targetLang,
                $word
            ),
            ['strictMatch' => 'true']
        );

        return new TranslationParser(
            json_decode($response->getBody()->getContents())->results
        );
    }
}
