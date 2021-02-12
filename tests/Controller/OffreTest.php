<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Offre;

class OffreTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/offres');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(30, $data['hydra:member']);
        $this->assertEquals(124, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Offre::class);
    }

    public function testCreateAnon(): void
    {
        $response = static::createClient()->request('POST', '/offres');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $client = self::authorization();
        $client->request('POST', '/offres', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        $client = self::authorization();
        $client->request('POST', '/offres', [
            'json' => [
                'nom' => 'Offre',
                'active' => false,
                'aide' => '/aides/1',
                'ouvrage' => '/ouvrages/1'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Offre::class);
    }

    public function testUpdateAnon(): void
    {
        static::createClient()->request('PUT', '/offres/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $client = self::authorization();
        $client->request('PUT', '/offres/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Offre::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteAnon(): void
    {
        static::createClient()->request('DELETE', '/offres/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $client = self::authorization();
        $client->request('DELETE', '/offres/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
