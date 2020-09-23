<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OuvrageFixtures extends Fixture
{
    /**
     * @var array
     */
    const OUVRAGES = [
        [ 'CODE' => 'ENV_01', 'NOM' => 'Isolation des murs par l\'extérieur' ],
        [ 'CODE' => 'TH_01', 'NOM' => 'Chaudières à haute performance énergétique' ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OUVRAGES as $row) {
            $ouvrage = (new \App\Entity\Ouvrage())
                ->setCode($row['CODE'])
                ->setNom($row['NOM']);

            $manager->persist($ouvrage);
            $this->addReference($row['CODE'], $ouvrage);
        }
        $manager->flush();
    }
}
