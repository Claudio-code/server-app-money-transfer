<?php

namespace App\Test\Unit;

use App\MoneyTransfer\User\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function testUuid(): void
    {
        // regex to validadate uuid v4
        $regex = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        $this->assertTrue((bool) preg_match($regex, $this->user->getUuid()));
    }

    public function testDates(): void
    {
        $date = new DateTime();

        $this->assertEquals(
            $date->getTimestamp(),
            $this->user->getCreatedAt()->getTimestamp()
        );
        $this->assertEquals(
            $date->getTimestamp(),
            $this->user->getUpdatedAt()->getTimestamp()
        );
    }
}
