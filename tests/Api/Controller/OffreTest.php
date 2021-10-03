<?php

namespace App\Tests\Api\Controller;

use App\Entity\Offre;

class OffreTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/offres');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(30, $data['hydra:member']);
        $this->assertEquals(30, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Offre::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/offres/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Offre::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/offres');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/offres', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/offres', [
            'json' => [
                'code' => 'offfre-01',
                'description' => 'test',
                'active' => false,
                'dateDebut' => '01-01-2020',
                'dispositif' => '/dispositifs/1'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Offre::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/offres/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/offres/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Offre::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/offres/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/offres/1');
        $this->assertResponseStatusCodeSame(204);
    }
}
