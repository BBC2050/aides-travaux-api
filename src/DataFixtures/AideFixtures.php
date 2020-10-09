<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Aide;
use App\Entity\Condition;
use App\Entity\Distributeur;
use App\Entity\Valeur;

class AideFixtures extends Fixture
{
    /**
     * @var array
     */
    const AIDES = [
        [
            'CODE' => 'MA_PRIME_RENOV',
            'NOM' => 'Ma Prime Rénov\'',
            'DELAI' => 'Versement après travaux',
            'TYPE' => 'prime',
            'DISTRIBUTEUR' => 'Agence nationale de l\'habitat',
            'CUMUL' => [ 'CEE_PRIME_ENERGIE', 'CEE_COUP_DE_POUCE', 'ECO_PTZ' ]
        ], [
            'CODE' => 'ANAH_HABITER_MIEUX',
            'NOM' => 'Habiter Mieux',
            'DELAI' => 'Versement avant travaux',
            'TYPE' => 'prime',
            'DISTRIBUTEUR' => 'Agence nationale de l\'habitat',
            'CUMUL' => [ 'CEE_PRIME_ENERGIE', 'CEE_COUP_DE_POUCE', 'ECO_PTZ' ]
        ], [
            'CODE' => 'CEE_PRIME_ENERGIE',
            'NOM' => 'Prime énergie',
            'DELAI' => 'Versement après travaux',
            'TYPE' => 'prime',
            'DISTRIBUTEUR' => 'Fournisseurs d\'énergie',
            'CUMUL' => [ 'MA_PRIME_RENOV', 'ANAH_HABITER_MIEUX', 'ECO_PTZ' ]
        ], [
            'CODE' => 'CEE_COUP_DE_POUCE',
            'NOM' => 'Coup de pouce économies d\'énergie',
            'DELAI' => 'Versement après travaux',
            'TYPE' => 'prime',
            'DISTRIBUTEUR' => 'Fournisseurs d\'énergie',
            'CUMUL' => [ 'MA_PRIME_RENOV', 'ANAH_HABITER_MIEUX', 'ECO_PTZ' ]
        ], [
            'CODE' => 'ECO_PTZ',
            'NOM' => 'Eco-prêt à taux zéro',
            'DELAI' => 'Versement avant travaux',
            'TYPE' => 'avance',
            'DISTRIBUTEUR' => 'Banques partenaires',
            'CUMUL' => [ 'MA_PRIME_RENOV', 'ANAH_HABITER_MIEUX', 'CEE_PRIME_ENERGIE', 'CEE_COUP_DE_POUCE', 'ECO_PTZ' ]
        ]
    ];

    public static function getConditions(Aide $aide)
    {
        switch ($aide->getCode()) {
            case 'MA_PRIME_RENOV':
                $condition = (new Condition())
                    ->setDescription('Les revenus du demandeur ne dépassent pas un certain montant')
                    ->setExpression("object.getCodeCategorieRessource() === 'MODESTE' || object.getCodeCategorieRessource() === 'TRES_MODESTE'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est achevé depuis au moins 2 ans')
                    ->setExpression('object.getAgeLogement() >= 2');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est occupé par son ou ses propriétaires')
                    ->setExpression("object.getCodeStatut() === 'PROP_OCCUPANT'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est occupé à titre de résidence principale')
                    ->setExpression("object.getCodeOccupation() === 'PRINCIPALE'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('La demande de prime intervient avant le démarrage des travaux');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Les travaux sont réalisés par une entreprise RGE');
                $aide->addCondition($condition);

                break;
            case 'ANAH_HABITER_MIEUX':
                $condition = (new Condition())
                    ->setDescription('Les revenus du demandeur ne dépassent pas un certain montant')
                    ->setExpression("object.getCodeCategorieRessource() === 'MODESTE' || object.getCodeCategorieRessource() === 'TRES_MODESTE'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est achevé depuis au moins 15 ans')
                    ->setExpression('object.getAgeLogement() >= 15');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est occupé par son ou ses propriétaires')
                    ->setExpression("object.getCodeStatut() === 'PROP_OCCUPANT'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('La demande de prime intervient avant le démarrage des travaux');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le demandeur n\'a pas bénéficié d\'un PTZ (prêt à taux zéro pour l\'accession à la propriété) depuis 5 ans');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Les travaux sont réalisés par une entreprise RGE');
                $aide->addCondition($condition);

                break;
            case 'ECO_PTZ':
                $condition = (new Condition())
                    ->setDescription('Le logement est achevé depuis au moins 2 ans')
                    ->setExpression('object.getAgeLogement() >= 2');
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est une maison ou un appartement')
                    ->setExpression("object.getCodeTypeLogement() === 'MAISON' || object.getCodeTypeLogement() === 'APPARTEMENT'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le demandeur est propriétaire de son logement')
                    ->setExpression("object.getCodeStatut() === 'PROP_OCCUPANT' || object.getCodeStatut() === 'PROP_BAILLEUR'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Le logement est occupé à titre de résidence principale')
                    ->setExpression("object.getCodeOccupation() === 'PRINCIPALE'");
                $aide->addCondition($condition);

                $condition = (new Condition())
                    ->setDescription('Les travaux sont réalisés par une entreprise RGE');
                $aide->addCondition($condition);

                break;
        }
    }

    public static function getValeurs(Aide $aide)
    {
        switch ($aide->getCode()) {
            case 'ECO_PTZ':
                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->addCondition((new Condition())
                        ->setDescription('Action seule')
                        ->setExpression("object.countOuvragesEligibles('ECO_PTZ')->count() === 1")
                    )
                    ->setDescription('Plafond')
                    ->setExpression('15000');
                $aide->addValeur($valeur);

                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->addCondition((new Condition())
                        ->setDescription('Bouquet de 2 travaux')
                        ->setExpression("object.countOuvragesEligibles('ECO_PTZ')->count() === 2")
                    )
                    ->setDescription('Plafond')
                    ->setExpression('25000');
                $aide->addValeur($valeur);

                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->addCondition((new Condition())
                        ->setDescription('Bouquet de 3 travaux ou plus')
                        ->setExpression("object.countOuvragesEligibles('ECO_PTZ')->count() >= 3")
                    )
                    ->setDescription('Plafond')
                    ->setExpression('30000');
                $aide->addValeur($valeur);

                break;
            case 'MA_PRIME_RENOV':
                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->setDescription('Plafond')
                    ->setExpression('20000');
                $aide->addValeur($valeur);

                break;
            case 'ANAH_HABITER_MIEUX':
                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->setDescription('Plafond')
                    ->addCondition((new Condition())
                        ->setDescription('Plafond pour les ménages modestes')
                        ->setExpression("object.getCodeCategorieRessource() === 'MODESTE'")
                    )
                    ->setExpression('8600');
                $aide->addValeur($valeur);

                $valeur = (new Valeur())
                    ->setType('plafond')
                    ->setDescription('Plafond')
                    ->addCondition((new Condition())
                        ->setDescription('Plafond pour les ménages très modestes')
                        ->setExpression("object.getCodeCategorieRessource() === 'TRES_MODESTE'")
                    )
                    ->setExpression('12000');
                $aide->addValeur($valeur);

                break;
        }
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::AIDES as $row) {
            $aide = (new Aide())
                ->setCode($row['CODE'])
                ->setNom($row['NOM'])
                ->setDescription('Une aide de test')
                ->setType($row['TYPE'])
                ->setDelai($row['DELAI'])
                ->setDistributeur((new Distributeur())
                    ->setNom($row['DISTRIBUTEUR'])
                )
                ->setActive(true);

            self::getConditions($aide);
            self::getValeurs($aide);

            $manager->persist($aide);
            $this->addReference($row['CODE'], $aide);
        }
        $manager->flush();

        foreach (self::AIDES as $row) {
            $aide = $this->getReference($row['CODE']);

            foreach ($row['CUMUL'] as $code) {
                $aide->addAideCumulable( $this->getReference($code) );
            }
            $manager->persist($aide);
        }
        $manager->flush();
    }
    
}
