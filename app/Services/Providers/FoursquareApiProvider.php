<?php

namespace App\Services\Providers;

use App\Interfaces\ApiProviderInterface;

class FoursquareApiProvider implements ApiProviderInterface
{
    /**
     * @return string
     */
    public function getApiBaseEndpoint(): string
    {
        return 'https://api.foursquare.com';
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return config('api.foursquare_api_key');
    }
}
