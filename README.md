# Aides Travaux API

## Quelles sont les aides concernées ?

Les aides financières à destination des particuliers relevant des dispositifs suivants :
    - Ma Prime Rénov'
    - Certificats d'économies d'énergie
    - Coupe de pouce économies d'énergie
    - Éco-prêt à taux zéro
    - Anah Habiter Mieux


## Utilisation

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