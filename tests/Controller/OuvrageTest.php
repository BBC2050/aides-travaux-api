<?php

namespace App\Tests\Controller\Core;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Ouvrage;

class OuvrageTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollectionAnon(): void
    {
        static::createClient()->request('GET', '/ouvrages');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollection(): void
    {        
        $response = static::createClient()->request('GET', '/ouvrages', [ 'headers' => self::authorization() ]);
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(2, $data['hydra:member']);
        $this->assertEquals(2, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Ouvrage::class);
    }

    public function testCreateAnon(): void
    {
        static::createClient()->request('POST', '/ouvrages');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        static::createClient()->request('POST', '/ouvrages', [
            'headers' => self::authorization(),
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        static::createClient()->request('POST', '/ouvrages', [
            'headers' => self::authorization(),
            'json' => [
                'code' => 'CODE',
                'nom' => 'Test'
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
        static::createClient()->request('PUT', '/ouvrages/1', [
            'headers' => self::authorization(),
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
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
        static::createClient()->request('DELETE', '/ouvrages/1', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(204);
    }
}
