<?php

namespace App\Tests\Controller\Core;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Utilisateur;

class UtilisateurTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollectionAnon(): void
    {
        static::createClient()->request('GET', '/utilisateurs');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollectionNotSuperAdmin(): void
    {
        static::createClient()->request('GET', '/utilisateurs', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(403);
    }

    public function testGetCollection(): void
    {        
        $response = static::createClient()->request('GET', '/utilisateurs', [ 'headers' => self::authorization(true) ]);
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(3, $data['hydra:member']);
        $this->assertEquals(3, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Utilisateur::class);
    }

    public function testCreateAnon(): void
    {
        static::createClient()->request('POST', '/utilisateurs');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateNotSuperAdmin(): void
    {
        static::createClient()->request('POST', '/utilisateurs', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(403);
    }

    public function testCreate(): void
    {
        static::createClient()->request('POST', '/utilisateurs', [
            'headers' => self::authorization(true),
            'json' => []
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertMatchesResourceItemJsonSchema(Utilisateur::class);
    }

    public function testDeleteAnon(): void
    {
        static::createClient()->request('DELETE', '/utilisateurs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDeleteNotSuperAdmin(): void
    {
        static::createClient()->request('DELETE', '/utilisateurs/1', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(403);
    }

    public function testDelete(): void
    {
        static::createClient()->request('DELETE', '/utilisateurs/1', [ 'headers' => self::authorization(true) ]);
        $this->assertResponseStatusCodeSame(204);
    }

}
