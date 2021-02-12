<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\OuvrageCategorie;

class CategorieFixtures extends Fixture
{
    /**
     * @var array
     */
    const CATEGORIES = [
        'Autres',
        'Chauffage',
        'Chauffage bois et biomasse',
        'Isolation thermique',
        'Pompes à chaleur',
        'Régulation',
        'Services',
        'Solaire thermique',
        'Ventilation'
    ];

    /**
     * @var string
     */
    const PREFIXE = 'CAT_';

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $index => $name) {
            $categorie = (new OuvrageCategorie)->setNom($name);

            $manager->persist($categorie);
            $this->addReference(self::PREFIXE.($index + 1), $categorie);
        }
        $manager->flush();
    }
}
