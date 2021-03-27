<?php

namespace App\Infra\Http\Form;

use App\Infra\Exceptions\MoneyTransferException;

class FormException extends \Exception implements MoneyTransferException
{
    public static function jsonRequestContentError(string $message): self
    {
        return new self($message, 404);
    }
}
