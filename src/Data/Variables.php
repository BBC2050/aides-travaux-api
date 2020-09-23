<?php

namespace App\Data;

abstract class Variables
{
    /**
     * @var array
     */
    const CODES_REGION = [
        '01', '02', '03', '04', '06', '11', '24', '27', '28',
        '32', '44', '52', '53', '75', '76', '84', '93', '94'
    ];

    /**
     * @var array
     */
    const CODES_DEPARTEMENT = [
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '2A','2B', '19',
        '21', '22', '23', '24', '25', '26', '27', '28', '29', '30',
        '31', '32', '33', '34', '35', '36', '37', '38', '39', '40',
        '41', '42', '43', '44', '45', '46', '47', '48', '49', '50',
        '51', '52', '53', '54', '55', '56', '57', '58', '59', '60',
        '61', '62', '63', '64', '65', '66', '67', '68', '69', '70',
        '71', '72', '73', '74', '75', '76', '77', '78', '79', '80',
        '81', '82', '83', '84', '85', '86', '87', '88', '89', '90',
        '91', '92', '93', '94', '95', '971', '972', '973', '974', '976'
    ];

    /**
     * @var array
     */
    const CODES_TYPE_PARTIE = [ 'PRIVATIVE', 'COMMUNE' ];

    /**
     * @var array
     */
    const CODES_TYPE_LOGEMENT = [ 'MAISON', 'APPARTEMENT', 'BAT_COLLECTIF' ];

    /**
     * @var array
     */
    const CODES_STATUT = [ 'PROP_OCCUPANT', 'PROP_BAILLEUR', 'LOCATAIRE', 'OCC_GRATUIT' ];

    /**
     * @var array
     */
    const CODES_OCCUPATION = [ 'PRINCIPALE', 'SECONDAIRE' ];

    /**
     * @var array
     */
    const CODES_ENERGIE_CHAUFFAGE = [ 'ELEC', 'GAZ', 'FIOUL', 'AUTRES' ];

    /**
     * @var array
     */
    const CODES_TYPE_CHAUFFAGE = [ 'INDIV', 'COLLECTIF' ];

    /**
     * @var array
     */
    const CODES_CATEGORIE_RESSOURCE = [ 'CLASSIQUE', 'MODESTE', 'TRES_MODESTE' ];

}