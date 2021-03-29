<?php

namespace App\MoneyTransfer\Transfer\UserTransferMoney;

use App\MoneyTransfer\Transfer\UserTransferMoney\ValidateTransaction\ValidateTransactionService;
use App\MoneyTransfer\User\User;
use App\MoneyTransfer\Wallet\Money;

class UserTransferMoneyService
{
    private ValidateTransactionService $validateTransactionService;

    public function __construct(
        ValidateTransactionService $validateTransactionService,
    ) {
        $this->validateTransactionService = $validateTransactionService;
    }

    public function execute(User $user, Money $money): void
    {
        $this->validateTransactionService->execute();
        $wallet = $user->getWallet();
        $wallet->subtractMoney($money->getValue());
        $user->setWallet($wallet);
    }
}
