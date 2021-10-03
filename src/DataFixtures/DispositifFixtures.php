<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Dispositif;

/**
 * * 1 dispositif par distributeur
 */
class DispositifFixtures extends Fixture implements DependentFixtureInterface
{
    const ITEMS = 5;
    const PREFIXE = 'DISPOSITIF_';

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < DistributeurFixtures::ITEMS; $i++) {
            $dispositif = (new Dispositif())
                ->setCode('dispositif-' . $i)
                ->setNom('Dispositif - ' . $i)
                ->setDescription('Description test')
                ->setType('prime')
                ->setActive(true)
                ->setDateDebut(new \DateTime('now'))
                ->setSecteur($this->getReference(SecteurFixtures::PREFIXE . '0'))
                ->setDistributeur($this->getReference(DistributeurFixtures::PREFIXE . $i));

            $manager->persist($dispositif);
            $this->addReference(self::PREFIXE . $i, $dispositif);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ DistributeurFixtures::class, SecteurFixtures::class ];
    }

}
