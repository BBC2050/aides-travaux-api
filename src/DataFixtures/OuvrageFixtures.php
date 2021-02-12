<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OuvrageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    const OUVRAGES = [
        [ 'CODE' => 'DIV_01', 'NOM' => 'Climatiseur performant', 'CATEGORIE' => '1'],
        [ 'CODE' => 'DIV_02', 'NOM' => 'Conduit d\'évacuation des produits de combustion', 'CATEGORIE' => '1'],
        [ 'CODE' => 'DIV_03', 'NOM' => 'Optimiseur de relance', 'CATEGORIE' => '1'],
        [ 'CODE' => 'DIV_04', 'NOM' => 'Rénovation globale', 'CATEGORIE' => '1'],
        [ 'CODE' => 'DIV_05', 'NOM' => 'Surperformance énergétique pour un bâtiment neuf', 'CATEGORIE' => '1'],
        [ 'CODE' => 'ENV_01', 'NOM' => 'Fenêtre ou porte-fenêtre avec vitrage isolant', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_02', 'NOM' => 'Fenêtre ou porte-fenêtre avec vitrage pariétodynamique', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_03', 'NOM' => 'Fermeture isolante', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_04', 'NOM' => 'Isolation de points singuliers d\'un réseau', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_05', 'NOM' => 'Isolation d\'un réseau hydraulique de chauffage ou d\'eau chaude sanitaire', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_06', 'NOM' => 'Isolation thermique des murs par l\'extérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_07', 'NOM' => 'Isolation thermique des murs par l\'intérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_08', 'NOM' => 'Isolation thermique des planchers bas par l\'extérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_09', 'NOM' => 'Isolation thermique des planchers bas par l\'intérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_10', 'NOM' => 'Isolation thermique des planchers de combles perdus', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_11', 'NOM' => 'Isolation thermique des rampants de toiture par l\'extérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_12', 'NOM' => 'Isolation thermique des rampants de toiture par l\'intérieur', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_13', 'NOM' => 'Isolation thermique des toitures-terrasses', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_14', 'NOM' => 'Protection solaire des parois opaques', 'CATEGORIE' => '4'],
        [ 'CODE' => 'ENV_15', 'NOM' => 'Protection solaire des parois vitrées', 'CATEGORIE' => '4'],
        [ 'CODE' => 'SE_01', 'NOM' => 'Accompagnement de projet', 'CATEGORIE' => '7'],
        [ 'CODE' => 'SE_02', 'NOM' => 'Audit énergétique', 'CATEGORIE' => '7'],
        [ 'CODE' => 'SE_03', 'NOM' => 'Contrat de Performance Énergétique Services', 'CATEGORIE' => '7'],
        [ 'CODE' => 'SE_04', 'NOM' => 'Dépose d\'une cuve à fioul', 'CATEGORIE' => '7'],
        [ 'CODE' => 'SE_05', 'NOM' => 'Service de suivi des consommations d\'énergie', 'CATEGORIE' => '7'],
        [ 'CODE' => 'TH_01', 'NOM' => 'Chaudière fioul à condensation', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_02', 'NOM' => 'Chaudière gaz à condensation', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_03', 'NOM' => 'Émetteur électrique performant', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_04', 'NOM' => 'Plancher chauffant hydraulique à basse température', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_05', 'NOM' => 'Raccordement à un réseau de chaleur', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_06', 'NOM' => 'Raccordement à un réseau de froid', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_07', 'NOM' => 'Récupérateur de chaleur à condensation', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_08', 'NOM' => 'Rédiateur basse température', 'CATEGORIE' => '2'],
        [ 'CODE' => 'TH_09', 'NOM' => 'Chaudière à bûches', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_10', 'NOM' => 'Chaudière à granulés', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_11', 'NOM' => 'Chaudière biomasse', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_12', 'NOM' => 'Cuisinière à bûches', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_13', 'NOM' => 'Cuisinières à bûches', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_14', 'NOM' => 'Foyers fermés', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_15', 'NOM' => 'Inserts', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_16', 'NOM' => 'Poêle à bûches', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_17', 'NOM' => 'Poêle à granulés', 'CATEGORIE' => '3'],
        [ 'CODE' => 'TH_18', 'NOM' => 'Chauffe-eau thermodynamique', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_19', 'NOM' => 'Pompe à chaleur air/air', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_20', 'NOM' => 'Pompe à chaleur air/eau ', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_21', 'NOM' => 'Pompe à chaleur eau/eau ', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_22', 'NOM' => 'Pompe à chaleur géothermique', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_23', 'NOM' => 'Pompe à chaleur hybride air/eau', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_24', 'NOM' => 'Pompe à chaleur solarothermique', 'CATEGORIE' => '5'],
        [ 'CODE' => 'TH_25', 'NOM' => 'Réglage des organes d\'équilibrage d\'une installation de chauffage à eau chaude', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_26', 'NOM' => 'Régulation par sonde de température extérieure', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_27', 'NOM' => 'Robinet thermostatique', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_28', 'NOM' => 'Système de comptage individuel d\'énergie de chauffage', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_29', 'NOM' => 'Système de régulation par programmation d\'intermittence', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_30', 'NOM' => 'Système de variation électronique de vitesse sur une pompe', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_31', 'NOM' => 'Thermostat avec régulation performante', 'CATEGORIE' => '6'],
        [ 'CODE' => 'TH_32', 'NOM' => 'Chauffe-eau solaire', 'CATEGORIE' => '8'],
        [ 'CODE' => 'TH_33', 'NOM' => 'Système solaire combiné', 'CATEGORIE' => '8'],
        [ 'CODE' => 'TH_34', 'NOM' => 'Système solaire hybride', 'CATEGORIE' => '8'],
        [ 'CODE' => 'TH_35', 'NOM' => 'Ventilation hybride hygroréglable', 'CATEGORIE' => '9'],
        [ 'CODE' => 'TH_36', 'NOM' => 'Ventilation mécanique contrôlée double flux', 'CATEGORIE' => '9'],
        [ 'CODE' => 'TH_37', 'NOM' => 'Ventilation mécanique contrôlée simple flux', 'CATEGORIE' => '9']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OUVRAGES as $row) {
            $ouvrage = (new \App\Entity\Ouvrage())
                ->setCode($row['CODE'])
                ->setNom($row['NOM'])
                ->setCategorie(
                    $this->getReference(CategorieFixtures::PREFIXE.$row['CATEGORIE'])
                );

            $manager->persist($ouvrage);
            $this->addReference($row['CODE'], $ouvrage);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ CategorieFixtures::class,VariableFixtures::class ];
    }
}
