<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={
 *              "offre:item:read",
 *              "valeur:item:read",
 *              "variable:item:read",
 *              "condition:item:read"
 *          }
 *      },
 *      denormalizationContext={
 *          "groups"={
 *              "offre:item:write",
 *              "valeur:item:i",
 *              "variable:item:i"
 *          }
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"offre:collection:read"}
 *              }
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"aide.id": "exact"})
 * @ORM\Entity
 * @ORM\Table(name="api_offre")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"offre" = "Offre", "offreCee" = "OffreCee"})
 */
class Offre
{
    use \App\Traits\OffreTrait;
    use \App\Traits\HasConditionsTrait;
    use \App\Traits\HasValeursTrait;

    /**
     * @var int
     * 
     * @Groups({
     *      "offre:item:read",
     *      "offre:collection:read",
     *      "aide:item:read",
     *      "ouvrage:item:read",
     *      "simulation:item:read"
     * })
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write", 
     *      "aide:item:read", 
     *      "ouvrage:item:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @var bool
     * 
     * @Groups({
     *      "offre:item:read", 
     *      "offre:collection:read", 
     *      "offre:item:write", 
     *      "aide:item:read", 
     *      "ouvrage:item:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotNull
     * @Assert\Type("bool")
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * @var Aide
     * 
     * @Groups({"offre:item:write", "simulation:offre:item:read"})
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Aide::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aide;

    /**
     * @var Ouvrage
     * 
     * @Groups({"offre:item:write"})
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Ouvrage::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ouvrage;

    /**
     * @var Collection|Valeur[]
     * 
     * @Groups({"simulation:item:read"})
     * @ORM\ManyToMany(
     *      targetEntity=Valeur::class,
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinTable(name="api_offre_valeur")
     */
    private $valeurs;

    /**
     * @var Collection|Variable[]
     * 
     * @ORM\ManyToMany(
     *      targetEntity=Variable::class,
     *      inversedBy="offres",
     *      cascade={"persist"}
     * )
     * @ORM\JoinTable(name="api_offre_variable")
     */
    private $variables;

    /**
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "condition:item:read",
     *      "condition:item:write",
     *      "simulation:item:read"
     * })
     * @ORM\ManyToMany(
     *      targetEntity=Condition::class,
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinTable(name="api_offre_condition")
     */
    private $conditions;

    public function __construct()
    {
        $this->variables = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
        $this->conditions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
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

    public function getOuvrage(): ?Ouvrage
    {
        return $this->ouvrage;
    }

    public function setOuvrage(?Ouvrage $ouvrage): self
    {
        $this->ouvrage = $ouvrage;

        return $this;
    }

    public function getValeurs(): Collection
    {
        return $this->valeurs;
    }

    public function addValeur(Valeur $valeur): self
    {
        if (!$this->valeurs->contains($valeur)) {
            $this->valeurs[] = $valeur;
        }

        return $this;
    }

    public function removeValeur(Valeur $valeur): self
    {
        if ($this->valeurs->contains($valeur)) {
            $this->valeurs->removeElement($valeur);
        }

        return $this;
    }

    public function getVariables(): Collection
    {
        return $this->variables;
    }

    public function addVariable(Variable $variable): self
    {
        if (!$this->variables->contains($variable)) {
            $this->variables[] = $variable;
        }

        return $this;
    }

    public function removeVariable(Variable $variable): self
    {
        if ($this->variables->contains($variable)) {
            $this->variables->removeElement($variable);
        }

        return $this;
    }

    /**
     * @return Collection|Condition[]
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Condition $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions[] = $condition;
        }

        return $this;
    }

    public function removeCondition(Condition $condition): self
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
        }

        return $this;
    }
}
