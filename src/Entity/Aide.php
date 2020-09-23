<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Model\Simulation;
use App\Repository\AideRepository;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"aide:item:read"},
 *          "enable_max_depth"=true
 *      },
 *      denormalizationContext={
 *          "groups"={"aide:item:write"},
 *          "enable_max_depth"=true
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"aide:collection:read"}
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
 *      },
 *      subresourceOperations={
 *          "api_aides_aides_cumulables_get_subresource"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"aide:subresource:read"}}
 *          }
 *      }
 * )
 * 
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={"nom": "partial"}
 * )
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={
 *          "distributeur.nom": "exact",
 *          "distributeur.perimetre": "exact"
 *      }
 * )
 * 
 * @UniqueEntity(fields={"code"})
 * @ORM\Entity(repositoryClass=AideRepository::class)
 * @ORM\Table(name="api_aide")
 */
class Aide
{
    use \App\Traits\AideTrait;
    use \App\Traits\HasConditionsTrait;
    use \App\Traits\HasValeursTrait;

    /**
     * @var int
     * 
     * @Groups({
     *      "aide:collection:read",
     *      "aide:subresource:read",
     *      "simulation:item:read",
     *      "simulation:offre:item:read"
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
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $code;

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $description;

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Choice(choices=Aide::TYPES)
     * @ORM\Column(type="string", length=180)
     */
    private $type;

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $delai;

    /**
     * @var bool
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("bool")
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @var Distributeur
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @ORM\ManyToOne(
     *      targetEntity=Distributeur::class,
     *      cascade={"persist"}
     * )
     */
    private $distributeur;

    /**
     * @var Collection|Offre[]
     * 
     * @Groups({"aide:item:read"})
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="aide")
     */
    private $offres;

    /**
     * @var Collection|Valeur[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write"
     * })
     * @ORM\ManyToMany(targetEntity=Valeur::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_aide_valeur")
     */
    private $valeurs;

    /**
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write"
     * })
     * @ORM\ManyToMany(targetEntity=Condition::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_aide_condition")
     */
    private $conditions;

    /**
     * @var Collection|Variable[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write"
     * })
     * @ORM\ManyToMany(
     *      targetEntity=Variable::class,
     *      inversedBy="aides",
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinTable(name="api_aide_variable")
     */
    private $variables;

    /**
     * @var Collection|Aide[]
     * 
     * @Groups({"aide:item:read", "simulation:item:read"})
     * @ApiSubresource
     * @ApiProperty(readableLink=false, writableLink=false)
     * @ORM\ManyToMany(targetEntity=Aide::class)
     * @ORM\JoinTable(name="api_aide_aide")
     */
    private $aidesCumulables;

    /**
     * @var Simulation|null
     */
    private $simulation;

    /**
     * @var Logo|null
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @ORM\OneToOne(targetEntity=Logo::class, cascade={"persist", "remove"})
     */
    private $logo;

    /**
     * @var array
     */
    const TYPES = [ 'prime', 'avance' ];

    public function __construct()
    {
        $this->offres = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
        $this->conditions = new ArrayCollection();
        $this->variables = new ArrayCollection();
        $this->aidesCumulables = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDelai(): ?string
    {
        return $this->delai;
    }

    public function setDelai(?string $delai): self
    {
        $this->delai = $delai;

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

    public function getDistributeur(): ?Distributeur
    {
        return $this->distributeur;
    }

    public function setDistributeur(?Distributeur $distributeur): self
    {
        $this->distributeur = $distributeur;

        return $this;
    }

    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setAide($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            if ($offre->getAide() === $this) {
                $offre->setAide(null);
            }
        }

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

    /**
     * @return Collection|Condition[]
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function toArrayConditions(): Collection
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
     * @return Collection|Aide[]
     */
    public function getAidesCumulables(): Collection
    {
        return $this->aidesCumulables;
    }

    public function toArrayAidesCumulabless(): array
    {
        return $this->aidesCumulables->getValues();
    }

    public function addAideCumulable(Aide $aide): self
    {
        if (!$this->aidesCumulables->contains($aide)) {
            $this->aidesCumulables[] = $aide;
        }

        return $this;
    }

    public function removeAideCumulable(Aide $aide): self
    {
        if ($this->aidesCumulables->contains($aide)) {
            $this->aidesCumulables->removeElement($aide);
        }

        return $this;
    }

    public function getLogo(): ?Logo
    {
        return $this->logo;
    }

    public function setLogo(?Logo $logo): self
    {
        $this->logo = $logo;

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

}
