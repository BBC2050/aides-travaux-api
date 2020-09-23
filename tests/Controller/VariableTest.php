<?php

namespace App\Tests\Controller\Core;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Variable;

class VariableTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollection(): void
    {        
        $response = static::createClient()->request('GET', '/variables', [ 'headers' => self::authorization() ]);
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(16, $data['hydra:member']);
        $this->assertEquals(16, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Variable::class);
    }

    public function testCreateAnon(): void
    {
        static::createClient()->request('POST', '/variables');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        static::createClient()->request('POST', '/variables', [
            'headers' => self::authorization(),
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        static::createClient()->request('POST', '/variables', [
            'headers' => self::authorization(),
            'json' => [
                'nom' => 'Nom',
                'description' => 'Description'
            ]
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertMatchesResourceItemJsonSchema(Variable::class);
    }

    public function testUpdateAnon(): void
    {
        static::createClient()->request('PUT', '/variables/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        static::createClient()->request('PUT', '/variables/1', [
            'headers' => self::authorization(),
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Variable::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }
    /*
    public function testDeleteAnon(): void
    {
        static::createClient()->request('DELETE', '/variables/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        static::createClient()->request('DELETE', '/variables/1', [ 'headers' => self::authorization() ]);
        $this->assertResponseStatusCodeSame(204);
    }*/
}
