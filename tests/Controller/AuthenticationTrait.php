<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

trait AuthenticationTrait
{
    public static function authorization($superAdmin = false): Client
    {
        $client = static::createClient();
        $response = $client->request('POST', '/authentication_token', [
            'json' => [
                'email' => $superAdmin ? 'superadmin@test.com' : 'admin@test.com',
                'plainPassword' => 'utilisateurtest',
            ]
        ]);

        $data = $response->toArray();

        $client = static::createClient();
        $client->setDefaultOptions(['auth_bearer' => $data['token']]);

        return $client;
        //return sprintf('Bearer %s', $data['token']);
    }
}
