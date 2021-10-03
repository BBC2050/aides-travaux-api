# Dispositif

## Présentation

### Couverture

| Dispositif | Présentation |
| :--------: | :----------: |
| Ma Prime Rénov' | Dispositif public pour le financement de la rénovation énergétique des logements individuels |
| Ma Prime Rénov' Copropriété | Dispositif public pour le financement de la rénovation énergétique des logements collectifs |
| Prime énergie | Estimation des primes dans le cadre du dispositif des Certificats d'Economies d'Energie |
| Coup de pouce | Primies minimales prévues par l'État dans le cadre du dispositif des Certificats d'Economies d'Energie |
| Habiter Mieux | Programme de lutte contre la précarité énergétique financé par l'Agence nationale de l'habitat |
| Eco prêt à taux zéro | Prêt sans intérêt pour le financement des travaux d'économies d'énergie |

### A venir

| Dispositif | Présentation |
| :--------: | :----------: |
| Agir Plus | Programme de maîtrise de l'énergie (MDE) financé par le dispositif des Certificats d'Economies d'Energie |
| Exonération | Dispositifs locaux d'éxonération de taxe foncière |

## Modélisation

<table>
    <thead>
        <tr>
            <th colspan=3>Dispositif</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>+id</td>
            <td>string</td>
            <td>Identifiant</td>
        </tr>
        <tr>
            <td>+secteur_id</td>
            <td>int</td>
            <td>Identifiant du secteur d'application</td>
        </tr>
        <tr>
            <td>+distributeur_id</td>
            <td>int</td>
            <td>Identifiant du distributeur</td>
        </tr>
        <tr>
            <td>+code</td>
            <td>string</td>
            <td>Code unique</td>
        </tr>
        <tr>
            <td>+nom</td>
            <td>string</td>
            <td>Nom du dispositif</td>
        </tr>
        <tr>
            <td>+description</td>
            <td>text</td>
            <td>[Markdown - RFC7764] Description du dispositif</td>
        </tr>
        <tr>
            <td>+type</td>
            <td>string</td>
            <td>Type de dispositif</td>
        </tr>
        <tr>
            <td>+active</td>
            <td>boolean</td>
            <td>Statut actif / inactif</td>
        </tr>
        <tr>
            <td>+dateDebut</td>
            <td>datetime</td>
            <td>Date d'entrée en vigueur du dispositif</td>
        </tr>
        <tr>
            <td>+dateFin</td>
            <td>datetime</td>
            <td>Date de fin du dispositif</td>
        </tr>
    </tbody>
</table>

### Nomenclature

#### Type de dispositif

| Type | Définition |
| :--: | :--------: |
| prime | Prime financière |
| avance | Prêt sans intérêt |
| exoneration | Exonération de taxes foncière |
| autres | Autres dispositifs (ex. TVA taux réduit) |
