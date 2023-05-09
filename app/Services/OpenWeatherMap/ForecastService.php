<?php

namespace App\Services\OpenWeatherMap;

use App\Interfaces\ForecastInterface;
use App\Services\AbstractApiService;
use App\Services\Providers\OpenWeatherMapApiProvider;
use Illuminate\Support\Arr;

class ForecastService extends AbstractApiService implements ForecastInterface
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
        return $this->apiProvider->getApiBaseEndpoint() . '/data/2.5/forecast';
    }

    /**
     * @param array $params
     * 
     * @return array
     */
    public function getForecast(array $params): array
    {
        $geocodeService = new GeocodeService($this->apiProvider);
        $geocodeResponse = $geocodeService->getGeocode($params['location']);

        if (empty($geocodeResponse)) {
            return [];
        }

        $response = $this->get([
            'lat'   => $geocodeResponse[0]['lat'],
            'lon'   => $geocodeResponse[0]['lon'],
            'units' => 'metric',
            'appid' => $this->apiProvider->getApiKey(),
        ]);

        return $this->filterForecast($response['list']);
    }

    /**
     * @param array $list
     * 
     * @return array
     */
    private function filterForecast(array $list): array
    {
        return Arr::map($list, function ($row) {
            return [
                'time'         => $row['dt_txt'],
                'temp'         => $row['main']['temp'],
                'weather'      => $row['weather'][0]['main'],
                'weather_desc' => $row['weather'][0]['description'],
            ];
        });
    }
}
