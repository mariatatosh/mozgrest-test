<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\OxfordDictionary\OxfordDictionaryClient;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class OxfordDictionaryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OxfordDictionaryClient::class, function (Application $app) {
            return new OxfordDictionaryClient(
                new Client([
                    'base_uri' => OxfordDictionaryClient::BASE_URI,
                    'headers' => [
                        'app_id' => config('oxford-dictionary.app_id'),
                        'app_key' => config('oxford-dictionary.api_key'),
                    ],
                ])
            );
        });
    }
}
