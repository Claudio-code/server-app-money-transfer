<?php

namespace App\MoneyTransfer\Wallet;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable() */
class Money implements \JsonSerializable
{
    /** @ORM\Column(type="float") */
    private float $value = 0;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function jsonSerialize(): float
    {
        return $this->value;
    }

    public function add(float $value): void
    {
        $this->value += $value;
    }
}
