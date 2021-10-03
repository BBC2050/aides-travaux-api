<?php

namespace App\Tests\Api\Controller;

use App\Entity\Utilisateur;

class UtilisateurTest extends AbstractTest
{
    public function testGetCollectionNotSuperAdmin(): void
    {
        $this->createClientWithAdminCredentials()->request('GET', '/utilisateurs');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testGetCollection(): void
    {
        $response = $this->createClientWithSuperAdminCredentials()->request('GET', '/utilisateurs');
        $data = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(2, $data['hydra:member']);
        $this->assertEquals(2, $data['hydra:totalItems']);
        $this->assertMatchesResourceCollectionJsonSchema(Utilisateur::class);
    }

    public function testGetUnauthorized(): void
    {
        $this->createClientWithAdminCredentials()->request('GET', '/utilisateurs/2');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testGet(): void
    {
        $this->createClientWithAdminCredentials()->request('GET', '/utilisateurs/1');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Utilisateur::class);

        $this->createClientWithSuperAdminCredentials()->request('GET', '/utilisateurs/1');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Utilisateur::class);
    }

    public function testCreateNotSuperAdmin(): void
    {
        $this->createClientWithAdminCredentials()->request('POST', '/utilisateurs');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testCreateInvalid(): void
    {
        $this->createClientWithSuperAdminCredentials()->request('POST', '/utilisateurs', [ 'json' => [] ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function testCreate(): void
    {
        $this->createClientWithSuperAdminCredentials()->request('POST', '/utilisateurs', [
            'json' => [
                'email' => 'johndoe@gmail.com',
                'plainPassword' => 'passwordtest'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Utilisateur::class);
    }

    public function testDeleteNotSuperAdmin(): void
    {
        $this->createClientWithAdminCredentials()->request('DELETE', '/utilisateurs/1');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testDelete(): void
    {
        $this->createClientWithSuperAdminCredentials()->request('DELETE', '/utilisateurs/1');
        $this->assertResponseStatusCodeSame(204);
    }
}
