<?php

namespace App\Tests\Api\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

abstract class AbstractTest extends ApiTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    protected function createClientWithSuperAdminCredentials(): Client
    {
        $token = $this->getToken(['email' => 'superadmin@test.com', 'plainPassword' => 'superadmin@test.com',]);
        return static::createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    protected function createClientWithAdminCredentials(): Client
    {
        $token = $this->getToken(['email' => 'admin@test.com', 'plainPassword' => 'admin@test.com',]);
        return static::createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    private function getToken(array $credentials): string
    {
        $response = static::createClient()->request('POST', '/login_check', ['json' => $credentials]);

        $data = json_decode($response->getContent());
        $this->token = $data->token;

        return $data->token;
    }
}
