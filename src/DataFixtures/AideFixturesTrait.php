<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\DistributeurFixtures;
use App\Entity\Aide;
use App\Entity\Condition;
use App\Entity\Expression;
use App\Entity\Valeur;

trait AideFixturesTrait
{    
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();

        $aide = (new Aide())
            ->setCode($data['CODE'])
            ->setNom($data['NOM'])
            ->setDescription($data['DESCRIPTION'])
            ->setType($data['TYPE'])
            ->setInformation($data['INFORMATION'])
            ->setActive($data['ACTIVE'])
            ->setDelai($data['DELAI'])
            ->setDistributeur(
                $this->getReference(DistributeurFixtures::PREFIXE.$data['DISTRIBUTEUR'])
            );

        foreach ($data['CONDITIONS'] as $item) {
            $condition = (new Condition())->setDescription($item['DESCRIPTION']);
            foreach ($item['EXPRESSIONS'] as $expression) {
                $condition->addExpression((new Expression())->setExpression($expression));
            }

            $aide->addCondition($condition);
        }

        foreach ($data['VALEURS'] as $item) {
            $valeur = (new Valeur())
                ->setType($item['TYPE'])
                ->setDescription($item['DESCRIPTION'])
                ->setExpression((new Expression())->setExpression($item['EXPRESSION']));

            foreach ($item['CONDITIONS'] as $itemCondition) {
                $condition = (new Condition())->setDescription($itemCondition['DESCRIPTION']);

                foreach ($itemCondition['EXPRESSIONS'] as $expression) {
                    $condition->addExpression((new Expression())->setExpression($expression));
                }
                $valeur->addCondition($condition);
            }
            $aide->addValeur($valeur);
        }

        foreach ($data['VARIABLES'] as $variable) {
            $aide->addVariable(
                $this->getReference(VariableFixtures::PREFIXE.$variable)
            );
        }

        $manager->persist($aide);
        $manager->flush();

        $this->addReference($data['CODE'], $aide);
    }
}
