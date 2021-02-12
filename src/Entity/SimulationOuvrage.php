<?php

namespace App\Entity;

use App\Resolver\ValeurResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_simulation_ouvrage")
 */
class SimulationOuvrage
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
     * @var Ouvrage
     * 
     * @Groups({"simulation:item:write", "simulation:item:read"})
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Ouvrage::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ouvrage;

    /**
     * @var Collection|Offre[]
     * 
     * @Groups({"simulation:offre:item:read"})
     */
    private $offres;

    /**
     * @var Simulation
     * 
     * @ORM\ManyToOne(targetEntity=Simulation::class, inversedBy="ouvrages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    /**
     * @var array
     * 
     * @Groups({"simulation:item:write"})
     * 
     * @Assert\Type("array")
     * @Assert\All({
     *      @Assert\AtLeastOneOf({
     *          @Assert\Type("string"),
     *          @Assert\Type("int"),
     *          @Assert\Type("float"),
     *          @Assert\Type("bool"),
     *      }),
     * })
     */
    private $variables = [];

    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOuvrage(): ?Ouvrage
    {
        return $this->ouvrage;
    }

    public function setOuvrage(?Ouvrage $ouvrage): self
    {
        $this->ouvrage = $ouvrage;

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
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $offre->setOuvrage($this);
            $this->offres[] = $offre;
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            $offre->setOuvrage(null);
        };

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffresEligibles(): Collection
    {
        return $this->offres->filter(function(Offre $offre) {
            return $offre->isEligible() === true;
        });
    }

    /**
     * Retourne les offres cumulables par type et par aide
     * 
     * @return Collection|Offre[]
     */
    public function getOffresCumulables(string $type = 'prime'): Collection
    {
        /**
         * @var array
         */
        $offres = [];

        /** 
         * Offres éligibles par type et par aide
         * 
         * @var Collection
         * */
        $offresEligibles = $this->getOffresEligibles()->filter(function(Offre $offre) use ($type) {
            return $offre->getAide()->getType() === $type;
        });

        foreach ($offresEligibles as $offre) {
            foreach ($offresEligibles as $item) {
                // Comparaison de la même offre
                if ($offre->getId() === $item->getId()) {
                    // Ajout automatique si l'offre analysée n'est pas référencée
                    if (!\in_array($offre->getId(), $offres)) {
                        $offres[] = $offre->getId();
                    }
                    continue;
                }
                // L'offre analysée est cumulable avec une autre offre
                if ($item->isCumulable($offre)) {
                    if (!\in_array($offre->getId(), $offres)) {
                        $offres[] = $offre->getId();
                    }
                    continue;
                }
                // L'offre analysée n'est pas cumulable avec une autre offre mais le montant de la prime est supérieur
                if (!$item->isCumulable($offre) && $offre->getMontant() >= $item->getMontant()) {
                    if (!\in_array($offre->getId(), $offres)) {
                        $offres[] = $offre->getId();
                    }
                    // Suppression de l'offre non cumulable d'une prime inférieur à l'offre analysée
                    if (\in_array($item->getId(), $offres)) {
                        $key = \array_search($item->getId(), $offres);
                        unset($offres[$key]);
                    }
                }
            }
        }

        return $offresEligibles->filter(function(Offre $offre) use ($offres) {
            return \in_array($offre->getId(), $offres);
        });
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables(array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Retourne le coût TTC de l'ouvrage
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getCout(): float
    {
        return \array_key_exists('COUT_TTC', $this->variables) ? (float) $this->variables['COUT_TTC'] : 0;
    }

    /**
     * Retoure le montant des primes éligibles et cumulables
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getPrimes(): float
    {
        $total = 0;
        $offres = $this->getOffresCumulables('prime');

        foreach ($this->simulation->getAides() as $aide) {
            $totalAide = 0;

            $offresParAide = $offres->filter(function(Offre $offre) use ($aide) {
                return $offre->getAide()->getId() === $aide->getAide()->getId();
            });

            foreach ($offresParAide as $offre) {
                $totalAide += $offre->getMontant();
            }
            $total += ValeurResolver::applyPlafonds($totalAide, $aide->getAide()->getValeurs());
        }

        return $total;
    }

    /**
     * Retoure le montant des avances éligibles et cumulables
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getAvances(): float
    {
        $total = 0;
        $offres = $this->getOffresCumulables('avance');

        foreach ($this->simulation->getAides() as $aide) {
            $totalAide = 0;

            $offresParAide = $offres->filter(function(Offre $offre) use ($aide) {
                return $offre->getAide()->getId() === $aide->getAide()->getId();
            });

            foreach ($offresParAide as $offre) {
                $totalAide += $offre->getMontant();
            }
            $total += ValeurResolver::applyPlafonds($totalAide, $aide->getAide()->getValeurs());
        }

        return $total;
    }
}
