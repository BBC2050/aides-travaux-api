<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Logo;

class LogoTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/logos');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(0, $data['hydra:member']);
        $this->assertEquals(0, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Logo::class);
    }
}
