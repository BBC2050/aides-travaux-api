<?php

namespace App\Tests\Api\Controller;

use App\Entity\ActionCategorie;

final class ActionCategorieTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/action_categories');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(10, $data['hydra:member']);
        $this->assertEquals(10, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(ActionCategorie::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/action_categories/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(ActionCategorie::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/action_categories');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/action_categories', [ 'json' => [] ]);
        
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/action_categories', [
            'json' => [
                'code' => 'categorie-01',
                'nom' => 'Catégorie',
                'secteur' => '/secteurs/1'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(ActionCategorie::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/action_categories/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/action_categories/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(ActionCategorie::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/action_categories/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/action_categories/1');
        $this->assertResponseStatusCodeSame(204);
    }

}
