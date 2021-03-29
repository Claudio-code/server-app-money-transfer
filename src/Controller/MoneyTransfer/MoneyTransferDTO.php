<?php

namespace App\Controller\MoneyTransfer;

use App\MoneyTransfer\Wallet\Money;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="MoneyTransferDTO",
 *     required=true,
 *     @OA\JsonContent(
 *          @OA\Property(type="string", property="userSendingMoney", default="37584366058"),
 *          @OA\Property(type="string", property="userReceivingMoney", default="02305232924"),
 *          @OA\Property(type="float", property="money", default=2.22),
 *    )
 * )
 */
class MoneyTransferDTO
{
    private string $userSendingMoney;
    private string $userReceivingMoney;
    private Money $money;

    public function getUserReceivingMoney(): string
    {
        return $this->userReceivingMoney;
    }

    public function setUserReceivingMoney(string $userReceivingMoney): self
    {
        $this->userReceivingMoney = $userReceivingMoney;

        return $this;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function setMoney(Money | float $money): void
    {
        if ($money instanceof Money) {
            $this->money = $money;
            return;
        }

        $this->money = new Money($money);
    }

    public function getUserSendingMoney(): string
    {
        return $this->userSendingMoney;
    }

    public function setUserSendingMoney(string $userSendingMoney): self
    {
        $this->userSendingMoney = $userSendingMoney;

        return $this;
    }
}
