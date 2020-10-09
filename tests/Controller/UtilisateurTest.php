<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Utilisateur;

class UtilisateurTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollectionNotSuperAdmin(): void
    {
        $client = self::authorization();
        $client->request('GET', '/utilisateurs');

        $this->assertResponseStatusCodeSame(403);
    }

    public function testGetCollection(): void
    {
        $client = self::authorization(true);
        $response = $client->request('GET', '/utilisateurs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(3, $data['hydra:member']);
        $this->assertEquals(3, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Utilisateur::class);
    }

    public function testCreateNotSuperAdmin(): void
    {
        $client = self::authorization();
        $client->request('POST', '/utilisateurs');

        $this->assertResponseStatusCodeSame(403);
    }

    public function testCreateInvalid(): void
    {
        $client = self::authorization(true);
        $client->request('POST', '/utilisateurs', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        $client = self::authorization(true);
        $client->request('POST', '/utilisateurs', [
            'json' => [
                'email' => 'johndoe@gmail.com',
                'plainPassword' => 'passwordtest'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Utilisateur::class);
    }

    public function testDeleteNotSuperAdmin(): void
    {
        $client = self::authorization();
        $client->request('DELETE', '/utilisateurs/1');

        $this->assertResponseStatusCodeSame(403);
    }

    public function testDelete(): void
    {
        $client = self::authorization(true);
        $client->request('DELETE', '/utilisateurs/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
