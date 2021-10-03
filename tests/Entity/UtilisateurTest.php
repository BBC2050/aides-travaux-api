<?php

namespace App\Tests\Entity;

use App\Entity\Utilisateur;

class UtilisateurTest extends AbstractTest
{
    public function getEntity(): Utilisateur
    {
        return (new Utilisateur())
            ->setEmail('johndoe@test.com')
            ->setRoles([])
            ->setPlainPassword('motdepassedetest');
    }

    public function testInvalidEmail(): void
    {
        $this->assertHasErrors($this->getEntity()->setEmail(''), 1);
        $this->assertHasErrors($this->getEntity()->setEmail('error'), 1);
    }

    public function testInvalidPlainPassword(): void
    {
        $this->assertHasErrors($this->getEntity()->setPlainPassword('123456'), 1);
    }

}
