<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Distributeur;

/**
 * * 5 items
 */
class DistributeurFixtures extends Fixture
{
    const ITEMS = 5;
    const PREFIXE = 'DISTRIBUTEUR_';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < self::ITEMS; $i++) { 
            $distributeur = (new Distributeur())
                ->setNom('Distributeur test - ' . $i)
                ->setDescription('Description');

            $manager->persist($distributeur);
            $this->addReference(self::PREFIXE . $i, $distributeur);
        }
        $manager->flush();
    }

}
