<?php

namespace App\Tests\Api\Controller;

use App\Api\Resource\Foyer;

final class FoyerTest extends AbstractTest
{
    public function testCollectionGet(): void
    {
        static::createClient()->request('GET', '/tranche_revenus');
        $this->assertResponseStatusCodeSame(405);
    }

    public function testCollectionPostInvalid(): void
    {
        static::createClient()->request('POST', '/tranche_revenus', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCollectionPost(): void
    {
        static::createClient()->request('POST', '/tranche_revenus', [
            'json' => [
                'codeRegion' => '01',
                'composition' => 2,
                'revenus' => 20000
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Foyer::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/tranche_revenus/1');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testUpdate(): void
    {
        static::createClient()->request('PUT', '/tranche_revenus/1');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDelete(): void
    {
        static::createClient()->request('DELETE', '/tranche_revenus/1');
        $this->assertResponseStatusCodeSame(404);
    }

}
