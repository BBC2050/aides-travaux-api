<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Offre;
use App\Entity\Zone;

/**
 * * - 1 offre globale par dispositif
 * * - 1 offre par action et par dispositif
 * *    - 2 offres par dispositif avec zones
 */
class OffreFixtures extends Fixture implements DependentFixtureInterface
{
    const ZONES = ['971', '972', '973', '974', '975'];

    public function loadOffresGlobales(ObjectManager $manager)
    {
        for ($i=0; $i < DispositifFixtures::ITEMS; $i++) {
            $offre = (new Offre())
                ->setCode('offre-' . $i)
                ->setNom('Offre globale - ' . $i)
                ->setDescription('Description test')
                ->setDateDebut(new \DateTime('now'))
                ->setActive(true)
                ->setDispositif($this->getReference(DispositifFixtures::PREFIXE . $i));
            
            $manager->persist($offre);
        }
        $manager->flush();
    }

    public function loadOffresAction(ObjectManager $manager)
    {
        for ($i=0; $i < DispositifFixtures::ITEMS; $i++) {
            for ($j=0; $j < ActionFixtures::ITEMS; $j++) { 
                $offre = (new Offre())
                    ->setCode('offre-' . $i)
                    ->setNom('Offre action - ' . $i)
                    ->setDescription('Description test')
                    ->setDateDebut(new \DateTime('2021-01-01'))
                    ->setActive(true)
                    ->setDispositif($this->getReference(DispositifFixtures::PREFIXE . $i))
                    ->addAction($this->getReference(ActionFixtures::PREFIXE . $j));
                
                if ($j > 2) {
                    foreach (self::ZONES as $zone) {
                        $offre->addZone((new Zone())->setCode($zone));
                    }
                }
                $manager->persist($offre);
            }
        }
        $manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadOffresGlobales($manager);
        $this->loadOffresAction($manager);
    }

    public function getDependencies()
    {
        return [ ActionFixtures::class, DispositifFixtures::class ];
    }

}
