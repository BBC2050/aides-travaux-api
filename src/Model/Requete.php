<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Aide;

abstract class Requete
{
    /**
     * @var Collection|Aide[]
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\Count(min=1)
     */
    protected $aides;

    /**
     * @var Collection|Ouvrage[]
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\Count(min=1)
     * @Assert\Valid
     */
    protected $ouvrages;

    /**
     * @var bool
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\Type("bool")
     */
    protected $local = false;

    public function __construct()
    {
        $this->ouvrages = new ArrayCollection();
        $this->aides = new ArrayCollection();
    }

    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(Ouvrage $ouvrage): self
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $ouvrage->setSimulation($this);
            $this->ouvrages[] = $ouvrage;
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): self
    {
        if ($this->ouvrages->contains($ouvrage)) {
            $this->ouvrages->removeElement($ouvrage);
        }

        return $this;
    }

    public function getAides(): Collection
    {
        return $this->aides;
    }

    public function addAide(Aide $aide): self
    {
        if (!$this->aides->contains($aide)) {
            $aide->setSimulation($this);
            $this->aides[] = $aide;
        }

        return $this;
    }

    public function removeAide(Aide $aide): self
    {
        if ($this->aides->contains($aide)) {
            $this->aides->removeElement($aide);
        }

        return $this;
    }

    public function isLocal(): bool
    {
        return (bool) $this->local;
    }

    public function setLocal(?bool $local): self
    {
        $this->local = $local;

        return $this;
    }
}
