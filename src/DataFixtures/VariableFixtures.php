<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Variable;
use App\Entity\VariableOption;

class VariableFixtures extends Fixture
{
    /**
     * @var array
     */
    const VARIABLES = [
        [
            'NOM' => 'AGE_LOGEMENT',
            'DESCRIPTION' => 'Âge du bâtiment concerné par les travaux',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'BESSOIN_ECS',
            'DESCRIPTION' => 'Besoin annuel en eau chaude sanitaire (en kWh par an)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'CEF_INITIAL',
            'DESCRIPTION' => 'Consommation conventionnelle initiale (en kWh/m² par an)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'CEF_PROJET',
            'DESCRIPTION' => 'Consommation conventionnelle du projet (en kWh/m² par an)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'CHALEUR_NETTE_UTILE',
            'DESCRIPTION' => 'Chaleur nette utile produite par la chaudière installée (en kWh par an)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'CODE_COMMUNE',
            'DESCRIPTION' => 'Code postal de la commune',
            'TYPE' => 'string',
            'OPTIONS' => []
        ], [
            'NOM' => 'CODE_DEPARTEMENT',
            'DESCRIPTION' => 'Code administratif du département',
            'TYPE' => 'string',
            'OPTIONS' => []
        ], [
            'NOM' => 'CODE_OCCUPATION',
            'DESCRIPTION' => 'Type d\'occupation du logement',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Résidence principale', 'VALEUR' => 'PRINCIPALE' ],
                [ 'TEXTE' => 'Résidence secondaire', 'VALEUR' => 'SECONDAIRE' ]
            ]
        ], [
            'NOM' => 'CODE_REGION',
            'DESCRIPTION' => 'Code administratif de la région',
            'TYPE' => 'string',
            'OPTIONS' => []
        ], [
            'NOM' => 'CODE_ENERGIE_CHAUFFAGE',
            'DESCRIPTION' => 'Energie de chauffage principale du bâtiment',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Électricité', 'VALEUR' => 'ELEC' ],
                [ 'TEXTE' => 'Gaz naturel', 'VALEUR' => 'GAZ' ],
                [ 'TEXTE' => 'Fioul', 'VALEUR' => 'FIOUL' ],
                [ 'TEXTE' => 'Autres', 'VALEUR' => 'AUTRES' ]
            ]
        ], [
            'NOM' => 'CODE_STATUT',
            'DESCRIPTION' => 'Statut du demandeur',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Propriétaire occupant', 'VALEUR' => 'PROP_OCCUPANT' ],
                [ 'TEXTE' => 'Propriétaire bailleur', 'VALEUR' => 'PROP_BAILLEUR' ],
                [ 'TEXTE' => 'Locataire', 'VALEUR' => 'LOCATAIRE' ],
                [ 'TEXTE' => 'Occupant à titre gratuit', 'VALEUR' => 'OCC_GRATUIT' ]
            ]
        ], [
            'NOM' => 'CODE_TYPE_CHAUFFAGE',
            'DESCRIPTION' => 'Type de chauffage principal du bâtiment',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Chauffage individuel', 'VALEUR' => 'INDIV' ],
                [ 'TEXTE' => 'Chauffage collectif', 'VALEUR' => 'COLLECTIF' ]
            ]
        ], [
            'NOM' => 'CODE_TYPE_LOGEMENT',
            'DESCRIPTION' => 'Type de bâtiment',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Maison individuelle', 'VALEUR' => 'MAISON' ],
                [ 'TEXTE' => 'Appartement', 'VALEUR' => 'APPARTEMENT' ],
                [ 'TEXTE' => 'Immeuble collectif', 'VALEUR' => 'BAT_COLLECTIF' ]
            ]
        ], [
            'NOM' => 'CODE_TYPE_VMC_DOUBLE_FLUX',
            'DESCRIPTION' => 'Type de VMC double flux',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'Autoréglable', 'VALEUR' => 'AUTO' ],
                [ 'TEXTE' => 'Modulé', 'VALEUR' => 'MOD' ]
            ]
        ], [
            'NOM' => 'COMPOSITION_FOYER',
            'DESCRIPTION' => 'Nombre de personnes composant le ménage',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'COUT_TTC',
            'DESCRIPTION' => 'Coût toutes taxes comprises des travaux',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'COUT_HT',
            'DESCRIPTION' => 'Coût toutes hors taxes des travaux',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'DUREE_GARANTIE',
            'DESCRIPTION' => 'Durée de garantie du contrat de performance énergétique (en année)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'EFFICACITE_ENERGETIQUE_SAISONNIERE',
            'DESCRIPTION' => 'Efficacité énergétique saisonnière de l\'équipement (en %)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'ETIQUETTE_DPE',
            'DESCRIPTION' => 'Étiquette DPE du logement',
            'TYPE' => 'string',
            'OPTIONS' => [
                [ 'TEXTE' => 'A', 'VALEUR' => 'A' ],
                [ 'TEXTE' => 'B', 'VALEUR' => 'B' ],
                [ 'TEXTE' => 'C', 'VALEUR' => 'C' ],
                [ 'TEXTE' => 'D', 'VALEUR' => 'D' ],
                [ 'TEXTE' => 'E', 'VALEUR' => 'E' ],
                [ 'TEXTE' => 'F', 'VALEUR' => 'F' ],
                [ 'TEXTE' => 'G', 'VALEUR' => 'G' ],
            ]
        ], [
            'NOM' => 'LONGUEUR_RESEAU',
            'DESCRIPTION' => 'Longueur isolée du réseau de chauffage ou d\'ECS hors du volume chauffé (en m)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'NOMBRE_CHAUDIERES',
            'DESCRIPTION' => 'Nombre de chaudières à raccorder',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'NOMBRE_EQUIPEMENTS',
            'DESCRIPTION' => 'Nombre d\'équipements à installer',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'NOMBRE_LOGEMENTS',
            'DESCRIPTION' => 'Nombre du logements',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'PRODUCTION_SOLAIRE',
            'DESCRIPTION' => 'Production solaire annuelle (en kWh)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'PUISSANCE_CHAUDIERE',
            'DESCRIPTION' => 'Puissance de la chaudière installée (en kW)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'RENOVATION_BBC',
            'DESCRIPTION' => 'Les travaux permettent-ils d\'atteindre un niveau BBC',
            'TYPE' => 'bool',
            'OPTIONS' => []
        ], [
            'NOM' => 'RESISTANCE_ISOLANT',
            'DESCRIPTION' => 'Résistance thermique de l\'isolant installé',
            'TYPE' => 'float',
            'OPTIONS' => []
        ], [
            'NOM' => 'REVENUS_FOYER',
            'DESCRIPTION' => 'Revenu fiscal de référence du ménage',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'SURFACE_CAPTEURS_SOLAIRES',
            'DESCRIPTION' => 'Surface des capteurs solaires installés (en m²)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'SURFACE_CHAUFFEE',
            'DESCRIPTION' => 'Surface chauffée par l\'équipement installé',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'SURFACE_HABITABLE',
            'DESCRIPTION' => 'Surface habitable du logement concerné par les travaux',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'SURFACE_ISOLANT',
            'DESCRIPTION' => 'Surface de l\'isolant installé',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'SURFACE_PROTEGEE',
            'DESCRIPTION' => 'Surface protégée des rayonnements solaires',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'TAUX_COUVERTURE_SOLAIRE',
            'DESCRIPTION' => 'Taux de couverture solaire (en %)',
            'TYPE' => 'int',
            'OPTIONS' => []
        ], [
            'NOM' => 'VALEUR_CEE_CLASSIQUE',
            'DESCRIPTION' => 'Valeur du certificat d\'économies d\'énergie classique',
            'TYPE' => 'float',
            'OPTIONS' => []
        ], [
            'NOM' => 'VALEUR_CEE_PRECARITE',
            'DESCRIPTION' => 'Valeur du certificat d\'économies d\'énergie précarité',
            'TYPE' => 'float',
            'OPTIONS' => []
        ]
    ];

    /**
     * @var string
     */
    const PREFIXE = 'VAR_';

    public function load(ObjectManager $manager)
    {
        foreach (self::VARIABLES as $item) {
            $variable = (new Variable())
                ->setNom($item['NOM'])
                ->setDescription($item['DESCRIPTION'])
                ->setType($item['TYPE']);

            foreach ($item['OPTIONS'] as $option) {
                $variable->addOption((new VariableOption())
                    ->setTexte($option['TEXTE'])
                    ->setValeur($option['VALEUR'])
                );
            }

            $manager->persist($variable);

            $this->addReference(self::PREFIXE.$item['NOM'], $variable);
        }
        $manager->flush();
    }
}
