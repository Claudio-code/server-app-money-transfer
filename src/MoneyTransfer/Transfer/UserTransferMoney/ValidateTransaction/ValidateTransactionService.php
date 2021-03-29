<?php

namespace App\MoneyTransfer\Transfer\UserTransferMoney\ValidateTransaction;

use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateTransactionService
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
            throw new UnauthorizedTransactionException(
                $httpException->getMessage(),
                $httpException->getCode()
            );
        }
    }
}
