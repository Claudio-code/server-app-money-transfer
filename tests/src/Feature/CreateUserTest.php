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
        'name' => 'ana',
        'email' => 'ana@gmail.com',
        'cpf' => '59792440003',
        'cnh' => '08613403611',
        'roles' => 'ROLE_SHOPKEEPER',
        'password' => 'AmarElo_5',
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
