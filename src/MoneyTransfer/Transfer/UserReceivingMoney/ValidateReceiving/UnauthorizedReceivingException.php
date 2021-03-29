<?php

namespace App\MoneyTransfer\Transfer\UserReceivingMoney\ValidateReceiving;

use App\Infra\Exceptions\MoneyTransferException;

class UnauthorizedReceivingException extends \Exception implements MoneyTransferException
{
}
