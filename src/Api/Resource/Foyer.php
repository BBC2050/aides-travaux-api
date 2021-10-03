<?php

namespace App\Api\Resource;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Services\Tranche\TrancheService;

class Foyer
{
    public int $id = 1;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min = 2, max = 2)
     */
    #[Groups(['read', 'write'])]
    public ?string $codeRegion = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\Positive
     */
    #[Groups(['read', 'write'])]
    public ?int $composition = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("float")
     * @Assert\PositiveOrZero
     */
    #[Groups(['read', 'write'])]
    public ?float $revenus = null;

    #[Groups(['read'])]
    public function getTrancheRevenus(): ?string
    {
        return TrancheService::get($this->codeRegion, $this->composition, $this->revenus);
    }

}
