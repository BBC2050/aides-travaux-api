<?php

namespace App\Utils;

abstract class HelperCategorieRessource
{
    /**
     * @param int Ressources du foyer
     * @param int Composition du foyer
     * @param string Code administratif de la région
     * @return null|string Catégorie de ressource
     */
    public static function get(int $ressources, int $compositionFoyer, string $codeRegion): ?string
    {
        switch ($codeRegion) {
            case '11':
                switch ($compositionFoyer) {
                    case 0:
                        return null;
                    case 1:
                        if ($ressources <= 20593) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 25068) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 2:
                        if ($ressources <= 30225) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 36792) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 3:
                        if ($ressources <= 36297) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 44188) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 4:
                        if ($ressources <= 42381) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 51597) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 5:
                        if ($ressources <= 48488) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 59026) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    default:
                        if ($ressources <= 48488 + ($compositionFoyer - 5) * 6096) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 59026 + ($compositionFoyer - 5) * 7422) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                }
                return null;
            
            default:
                switch ($compositionFoyer) {
                    case 0:
                        return null;
                    case 1:
                        if ($ressources <= 14879) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 19074) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 2:
                        if ($ressources <= 21760) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 27896) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 3:
                        if ($ressources <= 26170) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 33547) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 4:
                        if ($ressources <= 30572) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 39192) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    case 5:
                        if ($ressources <= 34993) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 44860) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                    default:
                        if ($ressources <= 34993 + ($compositionFoyer - 5) * 4412) {
                            return 'TRES_MODESTE';
                        } else if ($ressources <= 44860 + ($compositionFoyer - 5) * 5651) {
                            return 'MODESTE';
                        }
                        return 'CLASSIQUE';
                }
                return null;
        }
    }
}
