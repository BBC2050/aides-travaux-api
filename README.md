# Aides Travaux API

## Données de sortie

### Total du projet



## Variables

### Variables globales

#### Situation géographique

- CODE_REGION
- CODE_COMMUNE
- CODE_DEPARTEMENT

#### Caractéristiques du bâtiment

- AGE_LOGEMENT
- CODE_TYPE_LOGEMENT
- NOMBRE_LOGEMENTS
- SURFACE_HABITABLE
- CODE_TYPE_CHAUFFAGE
- CODE_ENERGIE_CHAUFFAGE
- ETIQUETTE_DPE
- BESSOIN_ECS

#### Situation du demandeur

- CODE_STATUT
- CODE_OCCUPATION
- COMPOSITION_FOYER
- REVENUS_FOYER

#### Informations complémentaires

- RENOVATION_BBC
- VALEUR_CEE_CLASSIQUE
- VALEUR_CEE_PRECARITE

### Variables d'ouvrage

#### Quantité

- LONGUEUR_RESEAU
- NOMBRE_CHAUDIERES
- NOMBRE_EQUIPEMENTS
- SURFACE_CAPTEURS_SOLAIRES
- SURFACE_CHAUFFEE
- SURFACE_ISOLANT
- SURFACE_PROTEGEE

#### Coût

- COUT_TTC
- COUT_HT

#### Caractéristiques techniques

- CEF_INITIAL
- CEF_PROJET
- CODE_TYPE_VMC_DOUBLE_FLUX
- DUREE_GARANTIE
- EFFICACITE_ENERGETIQUE_SAISONNIERE
- PRODUCTION_SOLAIRE
- PUISSANCE_CHAUDIERE
- RESISTANCE_ISOLANT
- TAUX_COUVERTURE_SOLAIRE
- CHALEUR_NETTE_UTILE

## Prise en main

### 1. Paramétrage du scénario

Trois scénarios sont disponibles :

- Recherche des aides par zone géographique
- Recherche des aides par distributeur
- Recherche des aides par aide

La requête envoyée retournera les aides disponibles, ainsi que les variables à renseigner.


### Recherche des aides

Une recherche des aides disponibles peut être effectuée sur la base des criètres suivants :

- Nom de l'aide (Ex. Ma Prime Rénov')
- Nom du distributeur (Ex. Agence nationale de l'habitat)
- Périmètre de l'aide (Ex. FR pour la France entière)

#### Exemple

Recherche des aides pour le département de l'Isère uniquement.

GET /aides?distributeur.perimetre[]=38

### Recherche des variables associées à une aide


1. Recherche des aides (optionnel)

Exemple: GET /aides?distributeur.perimetre[]=75015

2. Sélection des aides

Exemple:
{
    "aides": [
        "/aides/1",
        "/aides/2"
    ]
}

3. Complétion des données génériques

Exemple: 
{
    "compositionFoyer": 3,
    "revenusFoyer": 26000,
    "surfaceHabitable": 100
}

4. Sélection des ouvrages et intégration des variables par ouvrage

Exemple: GET /variables?offres.ouvrage=1&offres.aide=3

## Conditions

Des conditions peuvent être paramétrées pour chaque aide et/ou offre rattachée afin de déterminer l'éligibilité d'une demande. Elles se déclinent en deux types :

- Les **conditions simples** qui doivent toutes être satisfaites.
- Les **conditions groupées** dont au moins une doit être satisfaite.

### Format d'entrée

Ex. '$MA_VARIABLE <> "Test"'

### Format de sortie

Ex. 'object.maVariable() !== "Test"'

### Exemple

L'aide Ma Prime Rénov' est déclinée par catégorie de ressource (Bleu, Jaune, Violet, Rose).


## Sources
- [ADEME - Aides financières 2020](https://particuliers.ademe.fr/sites/default/files/2020-06/guide-pratique-aides-financieres-renovation-habitat-2020.pdf)
- [Fiche d'opérations standardisées - Bâtiment résidentiel](https://atee.fr/efficacite-energetique/club-c2e/fiches-doperations-standardisees/batiment-residentiel)
- [Décret n° 2020-26 du 14 janvier 2020 relatif à la prime de transition énergétique](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000041400291/)
- [Arrêté du 14 janvier 2020 relatif à la prime de transition énergétique](https://www.legifrance.gouv.fr/loda/id/JORFTEXT000041400376)
- [Eco-prêt à taux zéro - Opérations éligibles](http://www.cohesion-territoires.gouv.fr/sites/default/files/2019-10/guide_des_travaux_eligibles_et_necessaires_eco_ptz.pdf)
- [Arrêté du 30 mars 2009 relatif aux conditions d'application de dispositions concernant les avances remboursables sans intérêt destinées au financement de travaux de rénovation afin d'améliorer la performance énergétique des logements anciens](https://www.legifrance.gouv.fr/loda/id/LEGITEXT000020464723/)
