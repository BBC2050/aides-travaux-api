<?php

namespace App\Helper;

abstract class HelperZoneClimatique
{
    /**
     * @var array
     */
    const ZONES_CLIMATIQUES = [
        'H1' => [
            '01','02','03','05','08','10','14','15','19','21','23','25','27','28','38',
            '39','42','43','45','51','52','54','55','57','58','59','60','61','62','63',
            '67','68','69','70','71','73','74','75','76','77','78','80','87','88','89',
            '90','91','92','93','94','95'
        ],
        'H2' => [
            '04','07','09','12','16','17','18','22','24','26','29','31','32','33','35',
            '36','37','40','41','44','46','47','48','49','50','53','56','64','65','72',
            '79','81','82','84','85','86'
        ],
        'H3' => [
            '06','11','13','2A ','2B ','20','30','34','66','83'
        ]
    ];

    /**
     * @param string Code département
     * @return string Zone climatique
     */
    public static function get(?string $codeDepartement): ?string
    {
        foreach (self::ZONES_CLIMATIQUES as $zoneClimatique => $codesDepartement) {
            if ( \in_array($codeDepartement, $codesDepartement) ) {
                return $zoneClimatique;
            }
        }
        return null;
    }
}
