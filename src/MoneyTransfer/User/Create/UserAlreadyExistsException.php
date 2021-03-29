<?php

namespace App\MoneyTransfer\User\Create;

use App\Infra\Exceptions\MoneyTransferException;

class UserAlreadyExistsException extends \Exception implements MoneyTransferException
{
    public static function userFound(string $cpf): self
    {
        return new self("o usuario do cpf $cpf já existe no sistema.");
    }
}
