<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ActionCategorie;

/**
 * * 10 items
 */
class ActionCategorieFixtures extends Fixture implements DependentFixtureInterface
{
    const ITEMS = 10;
    const PREFIXE = 'ACTION_CATEGORIE_';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < self::ITEMS; $i++) { 
            $categorie = (new ActionCategorie())
                ->setCode('categorie-' . $i)
                ->setNom('Action')
                ->setSecteur($this->getReference('SECTEUR_0'));

            $manager->persist($categorie);
            $this->addReference(self::PREFIXE.$i, $categorie);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ SecteurFixtures::class ];
    }

}
