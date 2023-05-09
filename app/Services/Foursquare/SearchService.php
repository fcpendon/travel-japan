<?php

namespace App\Services\Foursquare;

use App\Interfaces\SearchInterface;
use App\Services\AbstractApiService;
use App\Services\Providers\FoursquareApiProvider;
use Illuminate\Support\Arr;

class SearchService extends AbstractApiService implements SearchInterface
{
    /**
     * @param FoursquareApiProvider $apiProvider
     */
    public function __construct(FoursquareApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->apiProvider->getApiBaseEndpoint() . '/v3/places/search';
    }

    /**
     * @param array $params
     * 
     * @return array
     */
    public function searchArea(array $params): array
    {
        $response = $this->get([
            'query' => $params['query'],
            'near'  => $params['near'],
            'limit' => $params['limit'],
        ], [
            'Authorization' => $this->apiProvider->getApiKey(),
        ]);

        if (isset($response['results']) === false) {
            return [];
        }

        return $this->filterSearch($response['results']);
    }

    /**
     * @param array $list
     * 
     * @return array
     */
    private function filterSearch(array $list): array
    {
        return Arr::map($list, function ($row) {
            return [
                'name' => $row['name'],
                'categories' => $this->enumerateList($row['categories'], 'name'),
                'address' => $row['location']['formatted_address'],
            ];
        });
    }

    /**
     * @param array $data
     * @param string $key
     * 
     * @return array
     */
    private function enumerateList(array $data, string $key): array
    {
        return Arr::map($data, function ($row) use ($key) {
            return $row[$key];
        });
    }
}
