<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\VariableFixtures;
use App\Entity\Condition;
use App\Entity\Expression;
use App\Entity\Offre;
use App\Entity\Valeur;

trait OffreFixturesTrait
{    
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();
        $aide = $this->getAide();

        foreach ($data as $item) {
            $offre = (new Offre())
                ->setNom($item['NOM'])
                ->setAide($this->getReference($aide))
                ->setActive(true);

            if ( \array_key_exists('FICHE', $item)) {
                $offre->setFiche($item['FICHE']);
            }
            if ( \array_key_exists('URL', $item)) {
                $offre->setUrl($item['URL']);
            }

            // Fetch ouvrages
            foreach ($item['OUVRAGES'] as $ouvrage) {
                $offre->addOuvrage($this->getReference($ouvrage));
            }
            // Fetch conditions
            foreach ($item['CONDITIONS'] as $itemCondition) {
                $condition = (new Condition())->setDescription($itemCondition['DESCRIPTION']);

                foreach ($itemCondition['EXPRESSIONS'] as $expression) {
                    $condition->addExpression((new Expression())->setExpression($expression));
                }
                $offre->addCondition($condition);
            }
            // Fetch valeurs
            foreach ($item['VALEURS'] as $itemValeur) {
                $valeur = (new Valeur())
                    ->setType($itemValeur['TYPE'])
                    ->setDescription($itemValeur['DESCRIPTION'])
                    ->setExpression((new Expression())->setExpression($itemValeur['EXPRESSION']));
    
                foreach ($itemValeur['CONDITIONS'] as $itemCondition) {
                    $condition = (new Condition())->setDescription($itemCondition['DESCRIPTION']);
    
                    foreach ($itemCondition['EXPRESSIONS'] as $expression) {
                        $condition->addExpression((new Expression())->setExpression($expression));
                    }
                    $valeur->addCondition($condition);
                }
                $offre->addValeur($valeur);
            }
            // Fetch variables
            foreach ($item['VARIABLES'] as $variable) {
                $offre->addVariable(
                    $this->getReference(VariableFixtures::PREFIXE.$variable)
                );
            }

            $manager->persist($offre);
        }
        $manager->flush();
    }
}
