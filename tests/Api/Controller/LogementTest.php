<?php

namespace App\Tests\Api\Controller;

use App\Api\Resource\Logement;

final class LogementTest extends AbstractTest
{
    public function testCollectionGet(): void
    {
        static::createClient()->request('GET', '/zone_climatique');
        $this->assertResponseStatusCodeSame(405);
    }

    public function testCollectionPostInvalid(): void
    {
        static::createClient()->request('POST', '/zone_climatique', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCollectionPost(): void
    {
        static::createClient()->request('POST', '/zone_climatique', [
            'json' => [
                'departement' => '01'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Logement::class);
    }

    public function testGet(): void
    {
        static::createClient()->request('GET', '/zone_climatique/1');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testUpdate(): void
    {
        static::createClient()->request('PUT', '/zone_climatique/1');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDelete(): void
    {
        static::createClient()->request('DELETE', '/zone_climatique/1');
        $this->assertResponseStatusCodeSame(404);
    }

}
