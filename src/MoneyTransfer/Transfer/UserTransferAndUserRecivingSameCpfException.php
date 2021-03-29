<?php

namespace App\MoneyTransfer\Transfer;

use App\Infra\Exceptions\MoneyTransferException;

class UserTransferAndUserRecivingSameCpfException extends \Exception implements MoneyTransferException
{
}
