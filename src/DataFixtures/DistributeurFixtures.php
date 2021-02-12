<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DistributeurFixtures extends Fixture
{
    /**
     * @var array
     */
    const DISTRIBUTEURS = [
        'Agence nationale de l\'habitat',
        'Fournisseurs d\'énergie',
        'Banques partenaires'
    ];

    /**
     * @var string
     */
    const PREFIXE = 'DISTRIB_';

    public function load(ObjectManager $manager)
    {
        foreach (self::DISTRIBUTEURS as $index => $name) {
            $distributeur = (new \App\Entity\Distributeur())
                ->setNom($name)
                ->setPerimetre('FR');

            $manager->persist($distributeur);
            $this->addReference(self::PREFIXE.($index + 1), $distributeur);
        }
        $manager->flush();
    }
}
