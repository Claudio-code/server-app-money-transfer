<?php

namespace App\MoneyTransfer\Transfer;

use App\Infra\Exceptions\MoneyTransferException;

class ShopkeeperNotTransferMoneyException extends \Exception implements MoneyTransferException
{
    public static function shopkeeperNotTransferMoney(string $name, string $cpf): self
    {
        return new self("O usuario de nome $name e cpf $cpf é um lojista e não pode tranbsferir dinheiro.", 401);
    }
}
