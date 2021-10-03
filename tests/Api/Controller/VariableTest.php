<?php

namespace App\Tests\Api\Controller;

use App\Entity\Variable;

class VariableTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/variables');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(10, $data['hydra:member']);
        $this->assertEquals(10, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Variable::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/variables/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Variable::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/variables');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/variables', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/variables', [
            'json' => [
                'categorie' => 'Test',
                'code' => '$T.ma_variable',
                'description' => 'Une variable de test',
                'type' => 'int'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Variable::class);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/variables/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/variables/1');
        $this->assertResponseStatusCodeSame(204);
    }
}
