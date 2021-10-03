<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Traits\HasConditionsTrait;
use App\Entity\Traits\HasValeursTrait;
use App\Repository\OffreRepository;

/**
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 * @ORM\Table(name="api_offre")
 */
class Offre
{
    use HasConditionsTrait, HasValeursTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['offre:read'])]
    private ?int $id = null;

    /**
     * Code interne
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private ?string $code = null;

    /**
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private ?string $nom = null;

    /**
     * Norme RFC7764
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=2000)
     * 
     * @ORM\Column(type="text")
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private ?string $description = null;

    /**
    * @Assert\NotBlank

    * @ORM\Column(type="datetime")
    */
    #[Groups(groups: ['offre:read', 'offre:write'])]
   private ?\DateTimeInterface $dateDebut = null;

   /**
    * @ORM\Column(type="datetime", nullable=true)
    */
    #[Groups(groups: ['offre:read', 'offre:write'])]
   private ?\DateTimeInterface $dateFin = null;

    /**
     * @Assert\NotNull
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean")
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private ?bool $active = false;

    /**
     * @Assert\NotNull
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean")
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private ?bool $multiple = false;

    /**
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Dispositif::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    #[Groups(groups: ['dispositif:read', 'offre:write'])]
    private ?Dispositif $dispositif = null;

    /**
     * @var Collection|Action[]
     * 
     * @ORM\ManyToMany(targetEntity=Action::class)
     * @ORM\JoinTable(name="api_offre_action")
     */
    
    #[Groups(groups: ['action:read', 'offre:write'])]
    private Collection $actions;

    /**
     * Liste des zones éligibles à l'offre
     * 
     * @var Collection|Zone[]
     * 
     * @Assert\Valid
     * 
     * @ORM\OneToMany(targetEntity=Zone::class, mappedBy="offre", cascade={"persist", "remove"})
     */
    #[Groups(groups: ['zone:read', 'zone:write'])]
    private Collection $zones;

    /**
     * @var Collection|Valeur[]
     * 
     * @Assert\Valid
     * 
     * @ORM\ManyToMany(targetEntity=Valeur::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_offre_valeur")
     */
    #[Groups(groups: ['valeur:read', 'valeur:write'])]
    protected Collection $valeurs;

    /**
     * @var Collection|Condition[]
     * 
     * @Assert\Valid
     * 
     * @ORM\ManyToMany(targetEntity=Condition::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_offre_condition")
     */
    #[Groups(groups: ['condition:read', 'condition:write'])]
    protected Collection $conditions;

    /**
     * @var Collection|OffreVariable[]
     * 
     * @Assert\Valid
     * 
     * @ORM\OneToMany(
     *      targetEntity=OffreVariable::class,
     *      mappedBy="offre",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    protected Collection $variables;

    /**
     * Liste des offres non cumulables
     * 
     * @var Collection|Offre[]
     * 
     * @ORM\ManyToMany(targetEntity=Offre::class)
     * @ORM\JoinTable(name="api_offre_offre")
     */
    #[Groups(groups: ['offre:read', 'offre:write'])]
    private Collection $exclusions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->zones = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
        $this->conditions = new ArrayCollection();
        $this->variables = new ArrayCollection();
        $this->exclusions = new ArrayCollection();
    }

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }
    
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getMultiple(): ?bool
    {
        return $this->multiple;
    }

    public function setMultiple(?bool $multiple): self
    {
        $this->multiple = $multiple;

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

    public function getActions(): array
    {
        return $this->actions->getValues();
    }

    public function getActionsCollection(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
        }

        return $this;
    }

    public function getZones(): array
    {
        return $this->zones->getValues();
    }

    /**
     * @return Collection|Zone[]
     */
    public function getZonesCollection(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
            $zone->setOffre($this);
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        if ($this->zones->removeElement($zone)) {
            // set the owning side to null (unless already changed)
            if ($zone->getOffre() === $this) {
                $zone->setOffre(null);
            }
        }

        return $this;
    }

    public function getExclusions(): array
    {
        return $this->exclusions->getValues();
    }

    public function getExclusionsCollection(): Collection
    {
        return $this->exclusions;
    }

    public function addExclusion(Offre $dispositif): self
    {
        if (!$this->exclusions->contains($dispositif)) {
            $this->exclusions[] = $dispositif;
        }

        return $this;
    }

    public function removeExclusion(Offre $dispositif): self
    {
        if ($this->exclusions->contains($dispositif)) {
            $this->exclusions->removeElement($dispositif);
        }

        return $this;
    }

    public function getVariables(): array
    {
        return $this->variables->getValues();
    }

    public function getVariablesCollection(): Collection
    {
        return $this->variables;
    }

    public function addVariable(OffreVariable $variable): self
    {
        if (!$this->variables->contains($variable)) {
            $this->variables[] = $variable;
        }

        return $this;
    }

    public function removeVariable(OffreVariable $variable): self
    {
        if ($this->variables->contains($variable)) {
            $this->variables->removeElement($variable);
        }

        return $this;
    }

    // Données de sortie

    #[Groups(groups: ['offre:read'])]
    public function getVariablesGlobales(): array
    {
        return $this->dispositif->getVariables();
    }

    // Validation

    /**
     * @Assert\Date
     */
    public function isDateDebutValid(): ?string
    {
        return $this->dateDebut ? $this->dateDebut->format('Y-m-d') : null;
    }

    /**
     * @Assert\Date
     */
    public function isDateFinValid(): ?string
    {
        return $this->dateFin ? $this->dateFin->format('Y-m-d') : null;
    }

    /**
     * @Assert\IsTrue
     */
    public function isVariablesValid(): bool
    {
        $variables = $this->variables->map(function(OffreVariable $item) {
            return $item->getVariable() ? $item->getVariable()->getCode() : null;
        })->getValues();

        foreach ($this->valeurs as $valeur) {
            foreach ($valeur->getVariables() as $variable) {
                if ($variable->isGlobale() && \in_array($variable, $variables) === false) {
                    return false;
                }
            }
        }
        foreach ($this->conditions as $condition) {
            foreach ($condition->getVariables() as $variable) {
                if ($variable->isGlobale() && \in_array($variable, $variables) === false) {
                    return false;
                }
            }
        }
        return true;
    }

}
