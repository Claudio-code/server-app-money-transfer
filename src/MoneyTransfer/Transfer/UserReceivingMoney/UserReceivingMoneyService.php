<?php

namespace App\MoneyTransfer\Transfer\UserReceivingMoney;

use App\MoneyTransfer\Transfer\UserReceivingMoney\ValidateReceiving\ValidateReceivingService;
use App\MoneyTransfer\User\User;
use App\MoneyTransfer\Wallet\Money;

class UserReceivingMoneyService
{
    private ValidateReceivingService $validateReceivingService;

    public function __construct(ValidateReceivingService $validateReceivingService)
    {
        $this->validateReceivingService = $validateReceivingService;
    }

    public function execute(User $user, Money $money): void
    {
        $this->validateReceivingService->execute();
        $wallet = $user->getWallet();
        $wallet->addMoney($money->getValue());
        $user->setWallet($wallet);
    }
}
