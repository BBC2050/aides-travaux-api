# Aides Travaux API

## Prise en main

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

### Exemple

L'aide Ma Prime Rénov' est déclinée par catégorie de ressource (Bleu, Jaune, Violet, Rose).
