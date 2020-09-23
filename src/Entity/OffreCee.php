<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class OffreCee extends Offre
{
    /**
     * @var string
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $fiche;

    /**
     * @var string
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Url
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $url;

    public function getFiche(): ?string
    {
        return $this->fiche;
    }

    public function setFiche(?string $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
