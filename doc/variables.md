# Variables

Liste des variables utilisées et, le cas échéant, des valeurs associées.

## Variables globales

Les tableau ci-dessous listent les variables globales.

### Données d'entrée

| Catégorie | Nom | Code | Type |
| :-------: | :-: | :--: | :--: |
| Foyer | Statut du demandeur | $F.statut | string |
| Foyer | Tranche de revenu de l'Agence nationale de l'habitat | $F.tranche_anah | string |
| Foyer | Tranche de revenu du dispositif Ma Prime Rénov' | $F.tranche_mpr | string |
| Foyer | Bénéfice d'un prêt à taux zéro pour l'accession à la propriété dans les cinq dernières années | $F.ptz | boolean |
| Logement | Ancienneté du logement | $L.age | integer |
| Logement | Le projet de travaux permet d'atteindre une performabce BBC - Bâtiment Basse Consommation | $L.bbc | boolean |
| Logement | Département du logement | $L.departement | integer |
| Logement | Ancienneté du logement | $L.age | integer |
| Logement | Ancienneté du logement | $L.age | integer |
| Logement | Ancienneté du logement | $L.age | integer |

#### Statuts - Options

| Valeur | Label |
| :----: | :---: |
| LOC | Locataire |
| OCC_GRAT | Occupant à titre gratuit |
| PROP_BAIL | Propriétaire bailleur |
| PROP_RES_1 | Propriétaire (résidence principale) |
| PROP_RES_2 | Propriétaire (résidence secondaire) |
| PROP_BAIL_SCI |Propriétaire bailleur membre d'une SCI |
| PROP_RES_1_SCI | Propriétaire occupant membre d'une SCI" |

#### Tranches de revenus de l'Agence nationale de l'habitat - Options

| Valeur | Label |
| :----: | :---: |
| TRES_MODESTE | Catégorie "Très modeste" |
| MODESTE | Catégorie "Modeste" |

#### Tranches de revenus du dispositif Ma Prime Rénov - Options

| Valeur | Label |
| :----: | :---: |
| TRES_MODESTE | Catégorie "Très modeste" |
| MODESTE | Catégorie "Modeste" |
| INTERMEDIAIRE | Catégorie "Intermédiaire" |
| SUPERIEUR | Catégorie "Supérieur" |

### Données intermédiaires


