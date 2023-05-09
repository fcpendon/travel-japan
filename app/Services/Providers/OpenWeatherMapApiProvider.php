<?php

namespace App\Services\Providers;

use App\Interfaces\ApiProviderInterface;

class OpenWeatherMapApiProvider implements ApiProviderInterface
{
    /**
     * @return string
     */
    public function getApiBaseEndpoint(): string
    {
        return 'https://api.openweathermap.org';
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return config('api.openweathermap_api_key');
    }
}
