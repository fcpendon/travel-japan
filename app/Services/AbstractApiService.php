<?php

namespace App\Services;

use App\Interfaces\ApiProviderInterface;
use Exception;
use Illuminate\Support\Facades\Http;

abstract class AbstractApiService
{
    protected ApiProviderInterface $apiProvider;

    /**
     * @param ApiProviderInterface $apiProvider
     */
    public function __construct(ApiProviderInterface $apiProvider) {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * @param string $endpoint
     * @param array $params
     * @param array $headers
     * 
     * @return array
     */
    protected function get(array $params = [], array $headers = []): array
    {
        try {
            return Http::withHeaders($headers)
                ->get($this->getEndpoint(), $params)
                ->json();
        } catch (Exception $e) {
            return response()->json([
                'status'  => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
