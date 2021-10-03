# Paramétrage

## Dispositif

### Distributeur

Un Dispositif doit être rattaché à un Distributeur parmis ceux disponibles.

### Secteur

Un Dispositif doit être rattaché à un Secteur d'application. Si le Secteur d'application sélectionné possède des Secteurs enfants, une erreur sera levée.

### Zones

Un Dispositif peut être rattaché à une ou plusieurs Zones d'application. Ces zones peuvent être :

- un code postal ;
- un code département ;
- un code région ;
- le code ISO de la France métropolitaine (249).

### Conditions

Les Conditions d'un Dispositif sont à paramétrer en respectant la nomenclature présentée dans la documentation.

### Valeurs

#### Types de valeurs

| Type | Description |
| :--: | :---------: |
| montant | Montant |
| terme | Terme à additionner |
| facteur | Facteur à appliquer au montant |
| depenses | Dépenses éligibles |
| plafond | Plafond applicable au montant calculé |
| plancher | Plancher applicable au montant calculé |
| ecretement | Plafond applicable après déduction d'autres primes |

#### Condition
Liste des variables acceptées :

- **Valeurs globales** :
    - Foyer
    - Situation

- **Autres valeurs** :
    - Foyer
    - Situation
    - Travaux
    - Intermédiaire

#### Périmètre d'application

| Valeur | Type | Périmètre | Variables |
| :--: | :-----: | :-------: |
| Valeur par défaut | montant | Offre | Toutes |
| Valeur par défaut | facteur | Offre | Toutes |
| Valeur par défaut | ecretement | Offre | Toutes |
| Valeur par défaut | plafond | Offre | Toutes |
| Valeur par défaut | plancher | Offre | Toutes |
| Valeur globale | plafond | Offre + Dispositif | Foyer / Situation |
| Valeur globale | plancher | Offre  + Dispositif| Foyer / Situation |


## Offres

### Les types d'Offres

#### Les offres globales

Les offres globales ne sont pas rattachées à une action d'économies d'énergie, mais à une autre offre du même dispositif. C'est par exemple le cas des bonus "Sortie de passoire" du dispositif Ma Prime Rénov'.

Pour être disponible et éligible, une offre non globale du même dispositif doit également l'être.

#### Les offres globales multiples

Par défaut, les offres globales s'appliquent une fois par action, et une fois par dispositif. Les offres globales multiples s'appliquent cependant autant de fois par dispositif que par action.
