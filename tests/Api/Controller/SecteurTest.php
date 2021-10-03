<?php

namespace App\Tests\Api\Controller;

use App\Entity\Secteur;

final class SecteurTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/secteurs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(5, $data['hydra:member']);
        $this->assertEquals(5, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Secteur::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/secteurs/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Secteur::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/secteurs');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/secteurs', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/secteurs', [
            'json' => [ 'code' => 'secteur-01', 'nom' => 'Catégorie' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Secteur::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/secteurs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/secteurs/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Secteur::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/secteurs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/secteurs/1');
        $this->assertResponseStatusCodeSame(204);
    }

}
