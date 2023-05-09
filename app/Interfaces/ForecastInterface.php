<?php

namespace App\Interfaces;

interface ForecastInterface
{
    /**
     * @param array $params
     * 
     * @return array
     */
    public function getForecast(array $params): array;
}
