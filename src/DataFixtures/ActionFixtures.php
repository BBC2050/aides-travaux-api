<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Action;

/**
 * * 5 actions par categorie
 */
class ActionFixtures extends Fixture implements DependentFixtureInterface
{
    const ITEMS = 5;
    const PREFIXE = 'ACTION_';

    public function load(ObjectManager $manager)
    {
        $counter = 0;

        for ($i=0; $i < ActionCategorieFixtures::ITEMS; $i++) { 
            for ($j=0; $j < self::ITEMS; $j++) { 
                $action = (new Action())
                    ->setCode('action-' . $counter)
                    ->setNom('Action')
                    ->setCategorie(
                        $this->getReference(ActionCategorieFixtures::PREFIXE . $i)
                    );

                $manager->persist($action);
                $this->addReference(self::PREFIXE . $counter, $action);

                $counter++;
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ ActionCategorieFixtures::class ];
    }

}
