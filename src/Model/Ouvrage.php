<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator\Constraints as AppAssert;
use App\Entity\Ouvrage as Ressource;

/**
 * @Assert\GroupSequence({"Ouvrage", "Strict"})
 * @AppAssert\VariableDefined(groups={"Strict"})
 */
class Ouvrage
{
    use \App\Traits\OuvrageTrait;

    /**
     * @var int
     * 
     * @Assert\NotBlank
     * @Assert\Positive
     * @AppAssert\OuvrageExists
     * @Groups({"simulation:item:read", "simulation:item:write"})
     */
    private $id;
    
    /**
     * @var float|null
     * 
     * @Assert\Type("float")
     * @Assert\PositiveOrZero
     * @Groups({"simulation:item:read", "simulation:item:write"})
     */
    private $surfaceIsolant;

    /**
     * @var float|null
     * 
     * @Assert\Type("float")
     * @Assert\PositiveOrZero
     * @Groups({"simulation:item:read", "simulation:item:write"})
     */
    private $quotePart = 1.0;

    /**
     * @var float|null
     * 
     * @Assert\Type("float")
     * @Assert\PositiveOrZero
     * @Groups({"simulation:item:read", "simulation:item:write"})
     */
    private $coutTtc;

    /**
     * @var Ressource
     * 
     * @Groups({"simulation:item:read"})
     */
    private $ressource;

    /**
     * @var Simulation
     */
    private $simulation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSurfaceIsolant(): ?float
    {
        return $this->surfaceIsolant;
    }

    public function setSurfaceIsolant(?float $surfaceIsolant): self
    {
        $this->surfaceIsolant = $surfaceIsolant;

        return $this;
    }

    public function getQuotePart(): ?float
    {
        return $this->quotePart;
    }

    public function setQuotePart(?float $quotePart): self
    {
        $this->quotePart = $quotePart;

        return $this;
    }

    public function getCoutTtc(): ?float
    {
        return $this->coutTtc;
    }

    public function setCoutTtc(?float $coutTtc): self
    {
        $this->coutTtc = $coutTtc;

        return $this;
    }

    public function getRessource(): ?Ressource
    {
        return $this->ressource;
    }

    public function setRessource(?Ressource $ressource): self
    {
        if ( $ressource ) {
            $ressource->setSimulation($this);
        }
        $this->ressource = $ressource;

        return $this;
    }
    
    public function getSimulation(): ?Simulation
    {
        return $this->simulation;
    }

    public function setSimulation(?Simulation $simulation): self
    {
        $this->simulation = $simulation;

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        return \method_exists($this->simulation, $name) ? $this->simulation->$name() : null;
    }

}
