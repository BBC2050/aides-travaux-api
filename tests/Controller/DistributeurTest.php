<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Distributeur;

class DistributeurTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/distributeurs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(3, $data['hydra:member']);
        $this->assertEquals(3, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Distributeur::class);
    }

    public function testGet(): void
    {
        $response = static::createClient()->request('GET', '/distributeurs/1');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Distributeur::class);
    }
}
