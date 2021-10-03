<?php

namespace App\Tests\Api\Controller;

use App\Entity\Action;

final class ActionTest extends AbstractTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/actions');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(30, $data['hydra:member']);
        $this->assertEquals(50, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Action::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/actions/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Action::class);
    }

    public function testCreateNotAllowed(): void
    {
        static::createClient()->request('POST', '/actions');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/actions', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/actions', [
            'json' => [
                'code' => 'Code',
                'nom' => 'Doe',
                'categorie' => '/action_categories/1'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Action::class);
    }

    public function testUpdateNotAllowed(): void
    {
        static::createClient()->request('PUT', '/actions/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testUpdate(): void
    {
        $this->createClientWithAdminCredentials()->request('PUT', '/actions/1', [
            'json' => [ 'nom' => 'Updated' ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Action::class);
        $this->assertJsonContains([ 'nom' => 'Updated' ]);
    }

    public function testDeleteNotAllowed(): void
    {
        static::createClient()->request('DELETE', '/actions/1');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testDelete(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/actions/1');
        $this->assertResponseStatusCodeSame(204);
    }

}
