<?php

namespace App\Services\Tranche;

class TrancheService
{
    public static function get(string $codeRegion, int $compositionFoyer, int $revenusFoyer): ?string
    {
        if ($codeRegion === '11') {
            if ($compositionFoyer === 1) {
                if ($revenusFoyer <= 20593) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 25068) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 38184) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 38184) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 2) {
                if ($revenusFoyer <= 30225) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 36792) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 56130) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 56130) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 3) {
                if ($revenusFoyer <= 36297) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 44188) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 67585) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 67585) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 4) {
                if ($revenusFoyer <= 42381) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 51597) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 79041) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 79041) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 5) {
                if ($revenusFoyer <= 48488) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 59026) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 90496) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 90496) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer > 5) {
                if ($revenusFoyer <= 48488 + ($compositionFoyer - 5) * 6096) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 59026 + ($compositionFoyer - 5) * 7422) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 90496 + ($compositionFoyer - 5) * 11455) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 90496 + ($compositionFoyer - 5) * 11455) {
                    return 'SUPERIEUR';
                }
            }
        } else {
            if ($compositionFoyer === 1) {
                if ($revenusFoyer <= 14879) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 19074) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 29148) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 29148) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 2) {
                if ($revenusFoyer <= 21760) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 27896) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 42848) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 42848) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 3) {
                if ($revenusFoyer <= 26170) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 33547) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 51592) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 51592) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 4) {
                if ($revenusFoyer <= 30572) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 39192) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 60336) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 60336) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer === 5) {
                if ($revenusFoyer <= 34993) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 44860) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 69081) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 69081) {
                    return 'SUPERIEUR';
                }
            } elseif ($compositionFoyer > 5) {
                if ($revenusFoyer <= 34993 + ($compositionFoyer - 5) * 4412) {
                    return 'TRES_MODESTE';
                } elseif ($revenusFoyer <= 44860 + ($compositionFoyer - 5) * 5651) {
                    return 'MODESTE';
                } elseif ($revenusFoyer <= 69081 + ($compositionFoyer - 5) * 8744) {
                    return 'INTERMEDIAIRE';
                } elseif ($revenusFoyer > 69081 + ($compositionFoyer - 5) * 8744) {
                    return 'SUPERIEUR';
                }
            }
        }
        return null;
    }

}
