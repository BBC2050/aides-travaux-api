<?php

namespace App\Tests\Api\Controller;

use App\Entity\Distributeur;

final class DistributeurTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/distributeurs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(5, $data['hydra:member']);
        $this->assertEquals(5, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Distributeur::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/distributeurs/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Distributeur::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/distributeurs');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/distributeurs', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/distributeurs', [
            'json' => [
                'nom' => 'Nom',
                'description' => 'Description'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Distributeur::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/distributeurs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/distributeurs/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Distributeur::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/distributeurs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/distributeurs/1');
        $this->assertResponseStatusCodeSame(204);
    }

}
