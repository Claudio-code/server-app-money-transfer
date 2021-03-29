<?php

namespace App\Infra\Http;

use GuzzleHttp\Client;

class HttpClientFactory
{
    /** @param mixed[] $config */
    public function create(array $config = []): Client
    {
        return new Client($config);
    }
}
