<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CoupDePouce\AideFixtures as CoupDePouceFixtures;
use App\DataFixtures\EcoPTZ\AideFixtures as EcoPTZFixtures;
use App\DataFixtures\HabiterMieux\AideFixtures as HabiterMieuxFixtures;
use App\DataFixtures\MaPrimeRenovBleu\AideFixtures as MaPrimeRenovBleuFixtures;
use App\DataFixtures\MaPrimeRenovJaune\AideFixtures as MaPrimeRenovJauneFixtures;
use App\DataFixtures\MaPrimeRenovViolet\AideFixtures as MaPrimeRenovVioletFixtures;
use App\DataFixtures\MaPrimeRenovRose\AideFixtures as MaPrimeRenovRoseFixtures;
use App\DataFixtures\MaPrimeRenovCopro\AideFixtures as MaPrimeRenovCoproFixtures;
use App\DataFixtures\PrimeEnergie\AideFixtures as PrimeEnergieFixtures;

class AidesCumulablesFixtures extends Fixture implements DependentFixtureInterface
{
    public function getData()
    {
        $data = [];
        $data[] = CoupDePouceFixtures::AIDE;
        $data[] = EcoPTZFixtures::AIDE;
        $data[] = HabiterMieuxFixtures::AIDE;
        $data[] = MaPrimeRenovBleuFixtures::AIDE;
        $data[] = MaPrimeRenovJauneFixtures::AIDE;
        $data[] = MaPrimeRenovVioletFixtures::AIDE;
        $data[] = MaPrimeRenovRoseFixtures::AIDE;
        $data[] = MaPrimeRenovCoproFixtures::AIDE;
        $data[] = PrimeEnergieFixtures::AIDE;

        return $data;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $item) {
            $aide = $this->getReference($item['CODE']);

            foreach ($item['CUMUL'] as $code) {
                $aide->addAideCumulable( $this->getReference($code) );
            }
            $manager->persist($aide);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CoupDePouceFixtures::class,
            EcoPTZFixtures::class,
            HabiterMieuxFixtures::class,
            MaPrimeRenovBleuFixtures::class,
            MaPrimeRenovJauneFixtures::class,
            MaPrimeRenovVioletFixtures::class,
            MaPrimeRenovRoseFixtures::class,
            MaPrimeRenovCoproFixtures::class,
            PrimeEnergieFixtures::class
        ];
    }
}
