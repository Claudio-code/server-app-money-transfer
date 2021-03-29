<?php

namespace App\MoneyTransfer\User;

use App\Infra\Exceptions\MoneyTransferException;

class UserNotFoundException extends \Exception implements MoneyTransferException
{
    public static function userWithThisCpfNotFound(string $cpf): self
    {
        return new self("O Usuario com esse cpf $cpf não coi encontrado.", 404);
    }
}
