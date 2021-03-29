<?php

namespace App\MoneyTransfer\Transfer\UserReceivingMoney\ValidateReceiving;

use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateReceivingService
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function execute(): void
    {
        try {
            $this->httpClient->request('get');
        } catch (HttpException $httpException) {
            throw new UnauthorizedReceivingException(
                $httpException->getMessage(),
                $httpException->getCode()
            );
        }
    }
}
