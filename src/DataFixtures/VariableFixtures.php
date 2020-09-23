<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VariableFixtures extends Fixture
{
    /**
     * @var array
     */
    const VARIABLES = [
        [
            'NOM' => 'CODE_REGION',
            'DESCRIPTION' => 'Code région du logement'
        ], [
            'NOM' => 'CODE_DEPARTEMENT',
            'DESCRIPTION' => 'Code département du logement'
        ], [
            'NOM' => 'COMPOSITION_FOYER',
            'DESCRIPTION' => 'Composition du foyer du demandeur'
        ], [
            'NOM' => 'REVENUS_FOYER',
            'DESCRIPTION' => 'Revenus du foyer du demandeur'
        ], [
            'NOM' => 'CODE_TYPE_PARTIE',
            'DESCRIPTION' => 'Type de partie concernée par les travaux (privative ou commune)'
        ], [
            'NOM' => 'CODE_TYPE_LOGEMENT',
            'DESCRIPTION' => 'Type de logement'
        ], [
            'NOM' => 'SURFACE_HABITABLE',
            'DESCRIPTION' => 'Surface habitable du logement'
        ], [
            'NOM' => 'AGE_LOGEMENT',
            'DESCRIPTION' => 'Âge du logement'
        ], [
            'NOM' => 'NOMBRE_LOGEMENTS',
            'DESCRIPTION' => 'Nombre de logements'
        ], [
            'NOM' => 'CODE_ENERGIE_CHAUFFAGE',
            'DESCRIPTION' => 'Energie de chauffage du logement'
        ], [
            'NOM' => 'CODE_TYPE_CHAUFFAGE',
            'DESCRIPTION' => 'Type de chauffage du logement'
        ], [
            'NOM' => 'CODE_STATUT',
            'DESCRIPTION' => 'Statut du demandeur'
        ], [
            'NOM' => 'CODE_OCCUPATION',
            'DESCRIPTION' => 'Mode d\'occupation du logement'
        ], [
            'NOM' => 'SURFACE_ISOLANT',
            'DESCRIPTION' => 'Surface d\'isolant installé'
        ], [
            'NOM' => 'QUOTE_PART',
            'DESCRIPTION' => 'Quote part des travaux à la charge du demandeur'
        ], [
            'NOM' => 'COUT_TTC',
            'DESCRIPTION' => 'Coût TTC de l\'ouvrage'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::VARIABLES as $row) {
            $variable = (new \App\Entity\Variable())
                ->setNom($row['NOM'])
                ->setDescription($row['DESCRIPTION']);
        
            $manager->persist($variable);
            $this->addReference($row['NOM'], $variable);
        }
        $manager->flush();
    }
}
