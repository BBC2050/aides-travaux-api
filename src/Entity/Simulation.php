<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Resolver\ValeurResolver;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"simulation:item:read", "simulation:offre:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"simulation:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"simulation:collection:read"}
 *              },
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "post"
 *      },
 *      itemOperations={"get"},
 * )
 * 
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 * @ORM\Table(name="api_simulation")
 */
class Simulation
{    
    /**
     * @var int
     * 
     * @Groups({
     *      "simulation:item:read",
     *      "simulation:collection:read"
     * })
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @Groups({
     *      "simulation:item:read",
     *      "simulation:collection:read"
     * })
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @var \DateTimeInterface
     * 
     * @Groups({"lead:collection:read", "lead:item:read"})
     * 
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @var Collection|SimulationAide[]
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * 
     * @Assert\Count(min=1)
     * @Assert\Valid
     * 
     * @ORM\OneToMany(
     *      targetEntity=SimulationAide::class,
     *      mappedBy="simulation",
     *      orphanRemoval=true,
     *      cascade={ "persist", "remove" }
     * )
     */
    private $aides;

    /**
     * @var Collection|SimulationOuvrage[]
     * 
     * @Groups({
     *      "simulation:item:read",
     *      "simulation:offre:item:read",
     *      "simulation:item:write"
     * })
     * 
     * @Assert\Count(min=1)
     * @Assert\Valid
     * 
     * @ORM\OneToMany(
     *      targetEntity=SimulationOuvrage::class,
     *      mappedBy="simulation",
     *      orphanRemoval=true,
     *      cascade={ "persist", "remove" }
     * )
     */
    private $ouvrages;

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
     *          @Assert\Type("bool")
     *      })
     * })
     */
    private $variables = [];

    public function __construct()
    {
        $this->aides = new ArrayCollection();
        $this->ouvrages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCodeValue(): self
    {
        $this->code = \strtoupper(\bin2hex(\random_bytes(2)));

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateCreationValue(): self
    {
        $this->dateCreation = new \Datetime();

        return $this;
    }

    /**
     * @return Collection|SimulationAide[]
     */
    public function getAides(): Collection
    {
        return $this->aides;
    }

    public function addAide(SimulationAide $aide): self
    {
        if (!$this->aides->contains($aide)) {
            $this->aides[] = $aide;
            $aide->setSimulation($this);
        }

        return $this;
    }

    public function removeAide(SimulationAide $aide): self
    {
        if ($this->aides->removeElement($aide)) {
            // set the owning side to null (unless already changed)
            if ($aide->getSimulation() === $this) {
                $aide->setSimulation(null);
            }
        }

        return $this;
    }

    /**
     * Retourne les ouvrages éligibles à l'aide en paramètre
     * 
     * @return Collection|SimulationOuvrage[]
     */
    public function getOuvragesEligibles(Aide $aide): Collection
    {
        return $this->ouvrages->filter(function(SimulationOuvrage $ouvrage) use ($aide) {
            $offres = $ouvrage->getOffres()->filter(function(Offre $offre) use ($aide) {
                return $aide->getId() === $offre->getAide()->getid() && $offre->isEligible();
            });
            return $offres->count() > 0;
        });
    }

    /**
     * @return Collection|SimulationOuvrage[]
     */
    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(SimulationOuvrage $ouvrage): self
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $this->ouvrages[] = $ouvrage;
            $ouvrage->setSimulation($this);
        }

        return $this;
    }

    public function removeOuvrage(SimulationOuvrage $ouvrage): self
    {
        if ($this->ouvrages->removeElement($ouvrage)) {
            // set the owning side to null (unless already changed)
            if ($ouvrage->getSimulation() === $this) {
                $ouvrage->setSimulation(null);
            }
        }

        return $this;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables(?array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Retourne le coût TTC des ouvrages
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getCoutTotal(): float
    {
        $total = 0;

        foreach ($this->getOuvrages() as $ouvrage) {
            $total += $ouvrage->getCout();
        }
        return (float) $total;
    }

    /**
     * Retour le total des primes éligibles
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getPrimes(): float
    {
        $total = 0;

        foreach ($this->aides as $aide) {
            $totalAide = 0;
            $offresParAide = new ArrayCollection();

            foreach ($this->ouvrages as $ouvrage) {
                foreach ($ouvrage->getOffresCumulables('prime') as $offre) {
                    if ($offre->getAide()->getId() === $aide->getAide()->getId()) {
                        $offresParAide->add($offre);
                    }
                }
            }

            foreach ($offresParAide as $offre) {
                $totalAide += $offre->getMontant();
            }
            $total += ValeurResolver::applyPlafonds($totalAide, $aide->getAide()->getValeurs());
        }

        return $total;
    }

    /**
     * Retour le total des avances éligibles
     * 
     * @Groups({"simulation:item:read"})
     */
    public function getAvances(): float
    {
        $total = 0;

        foreach ($this->aides as $aide) {
            $totalAide = 0;
            $offresParAide = new ArrayCollection();

            foreach ($this->ouvrages as $ouvrage) {
                foreach ($ouvrage->getOffresCumulables('avance') as $offre) {
                    if ($offre->getAide()->getId() === $aide->getAide()->getId()) {
                        $offresParAide->add($offre);
                    }
                }
            }

            foreach ($offresParAide as $offre) {
                $totalAide += $offre->getMontant();
            }
            $total += ValeurResolver::applyPlafonds($totalAide, $aide->getAide()->getValeurs());
        }

        return $total;
    }
}
