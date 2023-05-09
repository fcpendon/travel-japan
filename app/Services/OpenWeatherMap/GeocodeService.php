<?php

namespace App\Services\OpenWeatherMap;

use App\Services\AbstractApiService;
use App\Services\Providers\OpenWeatherMapApiProvider;

class GeocodeService extends AbstractApiService
{
    /**
     * @param OpenWeatherMapApiProvider $apiProvider
     */
    public function __construct(OpenWeatherMapApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->apiProvider->getApiBaseEndpoint() . '/geo/1.0/direct';
    }

    /**
     * @param string $location
     * 
     * @return array
     */
    public function getGeocode(string $location): array
    {
        return $this->get([
            'q'     => $location,
            'appid' => $this->apiProvider->getApiKey(),
        ]);
    }
}
