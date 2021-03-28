<?php

namespace App\Test\Feature;

use App\Tests\RequestTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserTest extends WebTestCase
{
    private KernelBrowser $client;

    private array $jsonParams = [
        'name' => 'carlos',
        'email' => 'shopkeeper@gmail.com',
        'cpf' => '02305232924',
        'cnh' => '1412341242',
        'roles' => 'ROLE_SHOPKEEPER',
        'password' => 'AmarElo_1',
        'money' => 5.34,
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }

    private function post(array $jsonContent): Response
    {
        $this->client->request(
            'POST',
            '/api/user/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($jsonContent)
        );

        return $this->client->getResponse();
    }

    public function testCreateUser(): void
    {
        $response = $this->post($this->jsonParams);
        $this->assertTrue($response->isSuccessful());
        $this->assertArrayHasKey('email', json_decode($response->getContent(), true));
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->post($this->jsonParams);
        $this->assertFalse($response->isSuccessful());
        $this->assertArrayHasKey('error', json_decode($response->getContent(), true));
        $this->assertEquals(400, $response->getStatusCode());
    }
}
