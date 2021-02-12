<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Aide;

class AideTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/aides');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(9, $data['hydra:member']);
        $this->assertEquals(9, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Aide::class);
    }

    public function testCreateAnon(): void
    {
        $response = static::createClient()->request('POST', '/aides');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $client = self::authorization();
        $client->request('POST', '/aides', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        $client = self::authorization();
        $client->request('POST', '/aides', [
            'json' => [
                'code' => 'M',
                'nom' => 'Doe',
                'description' => 'John',
                'information' => 'https://test.com',
                'type' => 'prime',
                'delai' => '75000',
                'active' => false,
                'distributeur' => [
                    'nom' => 'test'
                ]
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
        $client = self::authorization();
        $client->request('PUT', '/aides/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
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
        $client = self::authorization();
        $client->request('DELETE', '/aides/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
