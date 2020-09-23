<?php

namespace App\Tests\Controller\Core;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Aide;

class AideTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollectionAnon(): void
    {
        static::createClient()->request('GET', '/aides');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollection(): void
    {        
        $response = static::createClient()->request('GET', '/aides', [ 'headers' => self::authorization() ]);
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(5, $data['hydra:member']);
        $this->assertEquals(5, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Aide::class);
    }

    public function testCreateAnon(): void
    {
        static::createClient()->request('POST', '/aides');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        static::createClient()->request('POST', '/aides', [
            'headers' => self::authorization(),
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        static::createClient()->request('POST', '/aides', [
            'headers' => self::authorization(),
            'json' => [
                'code' => 'M',
                'nom' => 'Doe',
                'description' => 'John',
                'type' => '1 rue du test',
                'delai' => '75000',
                'distributeur' => 'Paris'
            ]
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertMatchesResourceItemJsonSchema(Aide::class);
    }

    public function testUpdateAnon(): void
    {
        static::createClient()->request('PUT', '/aides/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        static::createClient()->request('PUT', '/aides/1', [
            'headers' => self::authorization(),
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Aide::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteAnon(): void
    {
        static::createClient()->request('DELETE', '/aides/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        static::createClient()->request('DELETE', '/aides/1', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(204);
    }
}
