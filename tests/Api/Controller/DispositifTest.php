<?php

namespace App\Tests\Api\Controller;

use App\Entity\Dispositif;

class DispositifTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/dispositifs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(5, $data['hydra:member']);
        $this->assertEquals(5, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Dispositif::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/dispositifs/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Dispositif::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/dispositifs');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/dispositifs', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/dispositifs', [
            'json' => [
                'code' => 'dispositif-01',
                'nom' => 'test',
                'description' => 'test',
                'type' => 'prime',
                'dateDebut' => '2021-01-01',
                'active' => false,
                'secteur' => '/secteurs/1',
                'distributeur' => '/distributeurs/1'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Dispositif::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/dispositifs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/dispositifs/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Dispositif::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/dispositifs/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/dispositifs/1');
        $this->assertResponseStatusCodeSame(204);
    }

}
