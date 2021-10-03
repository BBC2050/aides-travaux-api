# Simulation

## Données d'entrée

### Processus

Une Simulation se déroule en XXX étapes.

#### 1. Sélection du Secteur d'application

##### Request

```
GET https://domain/secteurs
```

##### Response


#### 2. Sélection des Dispositifs

La première étape consiste à sélectionner les Dispositifs pour lesquels une Simulation est effectué

## Fonctionnement

1. Paramétrage des dispositifs
2. Paramétrage des actions
3. Paramétrage global

## Données de sortie

Pour chaque simulation, trois jeux de données sont retournés.

### Estimation par dispositif

### Estimation par offre

### Estimation par action






montant = min(∑ montants, plafond)

Ou :

**montants** est le montant optimisé de chaque dispositif 


````
{
    "dispositifs": [
        {
            "id": "ID du dispositif",
            "code": "Code du dispositif",
            "nom": "Nom du dispositif",
            "type: "Type du dispositif",
            "logoUrl": "URL du logo du dispositif",
            "distributeur": {
                "nom": "Nom du distributeur",
                "description": "Description du distributeur",
            },
            "eligible": "Eligibilité de la simulation au dispositif",
            "montant: "Montant maximum optimisé",
            "exclusions": "Liste des dispositifs non cumulables"
        }
    ],
    "actions": [
        {
            "id": "ID de l'action",
            "code": "Code de l'action",
            "nom": "Nom de l'action",
            "primes": "Montant optimisé des primes",
            "avances": "Montant optimisé des avances",
            "exonerations": "Montant optimisé des exonérations",
            "offres": [
                {
                    "id": "ID de l'offre",
                    "code": "Code de l'offre",
                    "dispositif": "ID du dispositif",
                    "nom": "Nom de l'offre",
                    "description": "Description de l'offre",
                    "exclusions": "Liste des offres non cumulables",
                    "montant": "Montant de l'offre pour l'action simulée"
                }
            ]
        }
    ]
}
````





## Valeurs

### Types d'expression



1. Application des valeurs relatives à l'offre, dans l'ordre suivant :
    1. Montant
    2. Facteurs
    3. Termes
    4. Plancher
    5. Plafonds

2. Application des valeurs relatives au dispositif, dans l'odre suivante :
    1. Montant
    2. Facteurs
    3. Termes
    4. Plancher
    5. Plafonds


#### Cas de plusieurs offres éligibles d'un même dispositif

L'offre dont le montant calculé est le plus important est retenu.

