<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Secteur;

/**
 * * 5 items
 */
class SecteurFixtures extends Fixture
{
    const ITEMS = 5;
    const PREFIXE = 'SECTEUR_';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < self::ITEMS; $i++) { 
            $secteur = (new Secteur())
                ->setCode('secteur-' . $i)
                ->setNom('Secteur test - ' . $i);

            $manager->persist($secteur);
            $this->addReference(self::PREFIXE . $i, $secteur);
        }
        $manager->flush();
    }

}
