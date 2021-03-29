<?php

namespace App\Test\Feature;

use App\MoneyTransfer\Transfer\ShopkeeperNotTransferMoneyException;
use App\MoneyTransfer\Transfer\UserTransferAndUserRecivingSameCpfException;
use App\MoneyTransfer\Wallet\InsufficientMoneyTransferException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TransferMoneyTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }

    private function post(array $jsonContent): Response
    {
        $this->client->request(
            'POST',
            '/api/transfer/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($jsonContent)
        );

        return $this->client->getResponse();
    }

    public function testShopkeeperTransferMoney(): void
    {
        $data = [
            'userSendingMoney' => '02305232924',
            'money' => 2,
            'userReceivingMoney' => '37584366058'
        ];

        $response = $this->post($data);
        [
            'type' => $type,
        ] = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($type, ShopkeeperNotTransferMoneyException::class);
    }

    public function testInsufficientMoney(): void
    {
        $data = [
            'userSendingMoney' => '37584366058',
            'money' => 88.4,
            'userReceivingMoney' => '02305232924'
        ];

        $response = $this->post($data);
        [
            'type' => $type,
        ] = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($type, InsufficientMoneyTransferException::class);
    }

    public function testSameCpf(): void
    {
        $data = [
            'userSendingMoney' => '37584366058',
            'money' => 88.4,
            'userReceivingMoney' => '37584366058'
        ];

        $response = $this->post($data);
        [
            'type' => $type,
        ] = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($type, UserTransferAndUserRecivingSameCpfException::class);
    }

    public function testTransferUserToShopkeeper(): void
    {
        $data = [
            'userSendingMoney' => '37584366058',
            'money' => 4,
            'userReceivingMoney' => '83605495087'
        ];

        $response = $this->post($data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccessful());
    }

    public function testTransferUserToUser(): void
    {
        $data = [
            'userSendingMoney' => '37584366058',
            'money' => 14,
            'userReceivingMoney' => '71507711069'
        ];

        $response = $this->post($data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccessful());
    }
}
