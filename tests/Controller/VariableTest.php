<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Variable;

class VariableTest extends ApiTestCase
{
    use \App\Tests\Controller\AuthenticationTrait;

    public function testGetCollection(): void
    {
        $client = self::authorization(true);
        $response = $client->request('GET', '/variables');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(37, $data['hydra:member']);
        $this->assertEquals(37, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Variable::class);
    }

    public function testCreateAnon(): void
    {
        $response = static::createClient()->request('POST', '/variables');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $client = self::authorization(true);
        $client->request('POST', '/variables', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreate(): void
    {
        $client = self::authorization(true);
        $client->request('POST', '/variables', [
            'json' => [
                'nom' => 'TEST',
                'description' => 'Une variable de test',
                'type' => 'int'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Variable::class);
    }

    public function testDeleteNotSuperAdmin(): void
    {
        $client = self::authorization();
        $client->request('DELETE', '/variables/1');

        $this->assertResponseStatusCodeSame(403);
    }

    public function testDelete(): void
    {
        $client = self::authorization(true);
        $client->request('DELETE', '/variables/1');

        $this->assertResponseStatusCodeSame(204);
    }
}
