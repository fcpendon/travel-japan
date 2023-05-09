<?php

namespace App\Interfaces;

interface SearchInterface
{
    /**
     * @param array $params
     * 
     * @return array
     */
    public function searchArea(array $params): array;
}
