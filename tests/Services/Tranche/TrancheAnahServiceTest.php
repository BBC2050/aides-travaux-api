<?php

namespace App\Tests\Services\Tranche;

use PHPUnit\Framework\TestCase;
use App\Services\Tranche\TrancheAnahService;

class TrancheAnahServiceTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGet(string $codeRegion, int $compositionFoyer, int $revenusFoyer, string $codeCategorie): void
    {
        $this->assertEquals(
            TrancheAnahService::get($codeRegion, $compositionFoyer, $revenusFoyer), $codeCategorie
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
            [ '', (5 + $supp), (\rand(34993 + 1, 44860) + (5651 * $supp)), 'MODESTE' ]
        ];
    }
}
