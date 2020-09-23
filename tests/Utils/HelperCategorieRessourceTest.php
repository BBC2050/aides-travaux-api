<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\HelperCategorieRessource;
use App\Data\Variables;

class HelperCategorieRessourceTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testGet(int $compositionFoyer, int $ressources, string $codeRegion, string $expect)
    {
        $this->assertEquals(
            HelperCategorieRessource::get($ressources, $compositionFoyer, $codeRegion),
            $expect
        );
    }

    public function provideData()
    {
        return [
            [ 1, 20593, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 1, 25068, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 1, 25068 + 1, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 2, 30225, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 2, 36792, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 2, 36792 + 1, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 3, 36297, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 3, 44188, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 3, 44188 + 1, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 4, 42381, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 4, 51597, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 4, 51597 + 1, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 5, 48488, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 5, 59026, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 5, 59026 + 1, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 6, 48488 + 6096, '11', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 6, 59026 + 7422, '11', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 6, 59027 + 7423, '11', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 1, 14879, '' , Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 1, 19074, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 1, 19074 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 2, 21760, '', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 2, 27896, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 2, 27896 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 3, 26170, '', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 3, 33547, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 3, 33547 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 4, 30572, '', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 4, 39192, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 4, 39192 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 5, 34993, '', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 5, 44860, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 5, 44860 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
            [ 6, 34993 + 4412, '', Variables::CODES_CATEGORIE_RESSOURCE[2] ],
            [ 6, 44860 + 5651, '', Variables::CODES_CATEGORIE_RESSOURCE[1] ],
            [ 6, 44860 + 5651 + 1, '', Variables::CODES_CATEGORIE_RESSOURCE[0] ],
        ];
    }
}
