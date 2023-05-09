<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetForecastRequest;
use App\Http\Requests\SearchAreaRequest;
use App\Interfaces\ForecastInterface;
use App\Interfaces\SearchInterface;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    private ForecastInterface $forecastService;
    private SearchInterface $searchService;

    /**
     * @param ForecastInterface $forecastService
     * @param SearchInterface $searchService
     */
    public function __construct(
        ForecastInterface $forecastService,
        SearchInterface $searchService
    ) {
        $this->forecastService = $forecastService;
        $this->searchService = $searchService;
    }

    /**
     * @param GetForecastRequest $request
     *
     * @return JsonResponse
     */
    public function getForecast(GetForecastRequest $request): JsonResponse
    {
        $params = $request->validated();
        $response = $this->forecastService->getForecast($params);

        return response()->json($response);
    }

    /**
     * @param SearchAreaRequest $request
     *
     * @return JsonResponse
     */
    public function searchArea(SearchAreaRequest $request): JsonResponse
    {
        $params = $request->validated();
        $response = $this->searchService->searchArea($params);

        return response()->json($response);
    }
}
