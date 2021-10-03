<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_zone")
 */
class Zone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Une zone peut être un code région, un code département, un code postal, ou au code ISO
     * de la France métropolitaine (249)
     * 
     * @Assert\NotBlank,
     * @Assert\Type("string"),
     * @Assert\AtLeastOneOf(
     *      @Assert\Regex("/^\d{5,5}$/"),
     *      @Assert\Regex("/^\d{2,3}$/"),
     *      @Assert\Choice({"2A", "2B"}),
     *      @Assert\Regex("/^\d{2,2}$/")
     * )
     * @ORM\Column(type="string", length=10)
     */
    #[Groups(groups: ['zone:read', 'zone:write'])]
    private ?string $code = null;

    /**
     * @ORM\ManyToOne(targetEntity=Dispositif::class, inversedBy="zones")
     */
    private ?Dispositif $dispositif = null;

    /**
     * @ORM\ManyToOne(targetEntity=Offre::class, inversedBy="zones")
     */
    private ?Offre $offre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDispositif(): ?Dispositif
    {
        return $this->dispositif;
    }

    public function setDispositif(?Dispositif $dispositif): self
    {
        $this->dispositif = $dispositif;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    /**
     * @Assert\IsTrue
     */
    public function isValide(): bool
    {
        if ($this->dispositif === null && $this->offre === null) {
            return false;
        }
        return true;
    }

}
