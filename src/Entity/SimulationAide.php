<?php

namespace App\Entity;

use App\Resolver\ValeurResolver;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_simulation_aide")
 */
class SimulationAide
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Aide
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Aide::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $aide;

    /**
     * @var Simulation
     * 
     * @ORM\ManyToOne(targetEntity=Simulation::class, inversedBy="aides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAide(): ?Aide
    {
        return $this->aide;
    }

    public function setAide(?Aide $aide): self
    {
        $this->aide = $aide;

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

    /**
     * @Groups({"simulation:item:read"})
     */
    public function isEligible(): bool
    {
        return $this->simulation->getOuvragesEligibles($this->aide)->count() > 0;
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getMontant(): float
    {
        $sum = 0;

        foreach ($this->simulation->getOuvrages() as $ouvrage) {
            foreach ($ouvrage->getOffres() as $offre) {
                if ($offre->getAide()->getId() === $this->aide->getId() && $offre->isEligible()) {
                    $sum += $offre->getMontant();
                }
            }
        }
        return ValeurResolver::applyPlafonds($sum, $this->aide->getValeurs());
    }

}
