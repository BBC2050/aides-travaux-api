<?php

namespace App\Tests\Entity;

use App\Entity\ActionCategorie;
use App\Entity\Secteur;

class ActionCategorieTest extends AbstractTest
{
    public function getEntity(): ActionCategorie
    {
        return (new ActionCategorie())
            ->setCode('categorie-01')
            ->setNom('Nom')
            ->setSecteur((new Secteur()));
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode(\bin2hex(\random_bytes(21))), 1);
    }

    public function testInvalidNom(): void
    {
        $this->assertHasErrors($this->getEntity()->setNom(null), 1);
        $this->assertHasErrors($this->getEntity()->setNom(''), 1);
        $this->assertHasErrors($this->getEntity()->setNom(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidSecteur(): void
    {
        $this->assertHasErrors($this->getEntity()->setSecteur(null), 1);
    }

}
