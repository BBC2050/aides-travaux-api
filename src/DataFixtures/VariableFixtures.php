<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Variable;

/**
 * * 10 items
 */
class VariableFixtures extends Fixture
{
    const ITEMS = 10;
    const PREFIXE = 'VARIABLE_';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < self::ITEMS; $i++) { 
            $variable = (new Variable())
                ->setCategorie('Catégorie')
                ->setCode('$T.variable_' . $i)
                ->setDescription('Description')
                ->setType('string');

            $manager->persist($variable);
            $this->addReference(self::PREFIXE . $i, $variable);
        }
        $manager->flush();
    }

}
