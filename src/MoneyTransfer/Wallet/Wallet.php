<?php

namespace App\MoneyTransfer\Wallet;

use App\MoneyTransfer\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WalletRepository::class)
 * @ORM\Table(name="wallets")
 */
class Wallet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /** @ORM\OneToOne(targetEntity="App\MoneyTransfer\User\User", mappedBy="wallet") */
    private User $user;

    /** @ORM\Embedded(class=Money::class) */
    private Money $money;

    public function __construct()
    {
        $this->money = new Money(0);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function setMoney(Money $money): void
    {
        $this->money = $money;
    }

    public function subtractMoney(float $valueSubtracted): void
    {
        $result = $this->money->getValue() - $valueSubtracted;
        if ($result < 0) {
            throw InsufficientMoneyTransferException::insufficientMoneyTransfer();
        }

        $this->money->setValue($result);
    }

    public function addMoney(float $value): void
    {
        $this->money->add($value);
    }
}
