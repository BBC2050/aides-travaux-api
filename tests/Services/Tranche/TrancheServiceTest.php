<?php

namespace App\Tests\Services\Tranche;

use PHPUnit\Framework\TestCase;
use App\Services\Tranche\TrancheService;

class TrancheServiceTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGet(string $codeRegion, int $compositionFoyer, int $revenusFoyer, string $codeCategorie): void
    {
        $this->assertEquals(
            TrancheService::get($codeRegion, $compositionFoyer, $revenusFoyer), $codeCategorie
        );
    }

    public function provider(): array
    {
        $supp = \rand(1, 10);

        return [
            // Île de france - Très modeste
            [ '11', 1, \rand(0, 20593), 'TRES_MODESTE' ],
            [ '11', 2, \rand(0, 30225), 'TRES_MODESTE' ],
            [ '11', 3, \rand(0, 36297), 'TRES_MODESTE' ],
            [ '11', 4, \rand(0, 42381), 'TRES_MODESTE' ],
            [ '11', 5, \rand(0, 48488), 'TRES_MODESTE' ],
            [ '11', (5 + $supp), (\rand(0, 48488) + (6096 * $supp)), 'TRES_MODESTE' ],
            // Hors ile de france - Très modeste
            [ '', 1, \rand(0, 14879), 'TRES_MODESTE' ],
            [ '', 2, \rand(0, 21760), 'TRES_MODESTE' ],
            [ '', 3, \rand(0, 26170), 'TRES_MODESTE' ],
            [ '', 4, \rand(0, 30572), 'TRES_MODESTE' ],
            [ '', 5, \rand(0, 34993), 'TRES_MODESTE' ],
            [ '', (5 + $supp), (\rand(0, 34993) + (4412 * $supp)), 'TRES_MODESTE' ],
            // Île de france - Modeste
            [ '11', 1, \rand(20593 + 1, 25068), 'MODESTE' ],
            [ '11', 2, \rand(30225 + 1, 36792), 'MODESTE' ],
            [ '11', 3, \rand(36297 + 1, 44188), 'MODESTE' ],
            [ '11', 4, \rand(42381 + 1, 51597), 'MODESTE' ],
            [ '11', 5, \rand(48488 + 1, 59026), 'MODESTE' ],
            [ '11', (5 + $supp), (\rand(48488 + 1, 59026) + (7422 * $supp)), 'MODESTE' ],
            // Hors ile de france - Modeste
            [ '', 1, \rand(14879 + 1, 19074), 'MODESTE' ],
            [ '', 2, \rand(21760 + 1, 27896), 'MODESTE' ],
            [ '', 3, \rand(26170 + 1, 33547), 'MODESTE' ],
            [ '', 4, \rand(30572 + 1, 39192), 'MODESTE' ],
            [ '', 5, \rand(34993 + 1, 44860), 'MODESTE' ],
            [ '', (5 + $supp), (\rand(34993 + 1, 44860) + (5651 * $supp)), 'MODESTE' ],
            // Île de france - Intermediaire
            [ '11', 1, \rand(25068 + 1, 38184), 'INTERMEDIAIRE' ],
            [ '11', 2, \rand(36792 + 1, 56130), 'INTERMEDIAIRE' ],
            [ '11', 3, \rand(44188 + 1, 67585), 'INTERMEDIAIRE' ],
            [ '11', 4, \rand(51597 + 1, 79041), 'INTERMEDIAIRE' ],
            [ '11', 5, \rand(59026 + 1, 90496), 'INTERMEDIAIRE' ],
            [ '11', (5 + $supp), (\rand(59026 + 1, 90496) + (11455 * $supp)), 'INTERMEDIAIRE' ],
            // Hors ile de france - Intermediaire
            [ '', 1, \rand(19074 + 1, 29148), 'INTERMEDIAIRE' ],
            [ '', 2, \rand(27896 + 1, 42848), 'INTERMEDIAIRE' ],
            [ '', 3, \rand(33547 + 1, 51592), 'INTERMEDIAIRE' ],
            [ '', 4, \rand(39192 + 1, 60336), 'INTERMEDIAIRE' ],
            [ '', 5, \rand(44860 + 1, 69081), 'INTERMEDIAIRE' ],
            [ '', (5 + $supp), (\rand(44860 + 1, 69081) + (8744 * $supp)), 'INTERMEDIAIRE' ],
            // Île de france - Supérieur
            [ '11', 1, \rand(38184 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '11', 2, \rand(56130 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '11', 3, \rand(67585 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '11', 4, \rand(79041 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '11', 5, \rand(90496 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '11', (5 + $supp), (\rand(90496 + 1, getrandmax()) + (11455 * $supp)), 'SUPERIEUR' ],
            // Hors ile de france - Supérieur
            [ '', 1, \rand(29148 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '', 2, \rand(42848 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '', 3, \rand(51592 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '', 4, \rand(60336 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '', 5, \rand(69081 + 1, getrandmax()), 'SUPERIEUR' ],
            [ '', (5 + $supp), (\rand(69081 + 1, getrandmax()) + (8744 * $supp)), 'SUPERIEUR' ],
        ];
    }
}
