<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Ouvrage;

class OuvrageTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/ouvrages');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(2, $data['hydra:member']);
        $this->assertEquals(2, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Ouvrage::class);
    }

    public function testCreateAnon(): void
    {
        $response = static::createClient()->request('POST', '/ouvrages');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $client = self::authorization();
        $client->request('POST', '/ouvrages', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        $client = self::authorization();
        $client->request('POST', '/ouvrages', [
            'json' => [
                'code' => 'Code',
                'nom' => 'Doe'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Ouvrage::class);
    }

    public function testUpdateAnon(): void
    {
        static::createClient()->request('PUT', '/ouvrages/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $client = self::authorization();
        $client->request('PUT', '/ouvrages/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Ouvrage::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteAnon(): void
    {
        static::createClient()->request('DELETE', '/ouvrages/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $client = self::authorization();
        $client->request('DELETE', '/ouvrages/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
