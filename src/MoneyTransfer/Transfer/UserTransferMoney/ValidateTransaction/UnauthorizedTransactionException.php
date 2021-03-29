<?php

namespace App\MoneyTransfer\Transfer\UserTransferMoney\ValidateTransaction;

use App\Infra\Exceptions\MoneyTransferException;

class UnauthorizedTransactionException extends \Exception implements MoneyTransferException
{
}
