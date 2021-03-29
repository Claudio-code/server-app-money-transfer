<?php

namespace App\MoneyTransfer\Wallet;

use App\Infra\Exceptions\MoneyTransferException;

class InsufficientMoneyTransferException extends \Exception implements MoneyTransferException
{
    public static function insufficientMoneyTransfer(): self
    {
        return new self('Dinheiro insuficiente para fazer a transferencia.', 406);
    }
}
