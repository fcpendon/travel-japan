<?php

namespace App\Interfaces;

interface ApiProviderInterface
{
    /**
     * @return string
     */
    public function getApiKey(): string;

    /**
     * @return string
     */
    public function getApiBaseEndpoint(): string;
}
