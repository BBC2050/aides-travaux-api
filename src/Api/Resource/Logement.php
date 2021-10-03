<?php

namespace App\Api\Resource;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Services\Geo\ZoneClimatiqueService;

class Logement
{
    public int $id = 1;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 2, max = 3)
     */
    #[Groups(['read', 'write'])]
    public ?string $departement = null;

    #[Groups(['read'])]
    public function getZoneClimatique(): ?string
    {
        return ZoneClimatiqueService::get($this->departement);
    }

}
