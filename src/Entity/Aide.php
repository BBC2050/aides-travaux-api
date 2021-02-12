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
 *      properties={"nom": "partial", "distributeur.nom": "exact", "distributeur.perimetre": "exact"}
 * )
 * 
 * @UniqueEntity(fields={"code"})
 * 
 * @ORM\Entity
 * @ORM\Table(name="api_aide")
 */
class Aide
{
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:collection:read",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Code d'identification de l'aide
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $code;

    /**
     * Nom de l'aide financière
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * Description de l'aide financière
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $description;

    /**
     * Type de l'aide financière
     * - prime
     * - avance
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Choice(choices=Aide::TYPES)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $type;

    /**
     * Délai de versement de l'aide
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $delai;

    /**
     * Ressources externes
     * 
     * @var array|null
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\Type("array")
     * @Assert\All({
     *      @Assert\NotBlank,
     *      @Assert\Type("array"),
     *      @Assert\Collection(
     *          fields = {
     *              "texte" = {
     *                  @Assert\NotBlank,
     *                  @Assert\Type("string"),
     *                  @Assert\Length(max = 100)
     *              },
     *              "url" = {
     *                  @Assert\NotBlank,
     *                  @Assert\Url,
     *              }
     *          },
     *          allowMissingFields = false
     *      )
     * })
     * 
     * @ORM\Column(type="array", nullable=true)
     */
    private $ressources = [];

    /**
     * Statut de l'aide
     * 
     * @var bool
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotNull
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * Distributeur de l'aide
     * 
     * @var Distributeur
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(
     *      targetEntity=Distributeur::class,
     *      cascade={"persist"}
     * )
     */
    private $distributeur;

    /**
     * Logo de l'aide
     * 
     * @var Logo|null
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * 
     * @ORM\OneToOne(targetEntity=Logo::class)
     */
    private $logo;

    /**
     * Liste des offres
     * 
     * @var Collection|Offre[]
     * 
     * @Groups({"aide:item:read"})
     * 
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="aide", cascade={"persist", "remove"})
     */
    private $offres;

    /**
     * Liste des valeurs
     * 
     * @var Collection|Valeur[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write"
     * })
     * 
     * @ORM\ManyToMany(targetEntity=Valeur::class, orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_aide_valeur")
     */
    private $valeurs;

    /**
     * Liste des conditions
     * 
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * 
     * @ORM\ManyToMany(targetEntity=Condition::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_aide_condition")
     */
    private $conditions;

    /**
     * Liste des variables
     * 
     * @var Collection|Variable[]
     * 
     * @Groups({"aide:item:read", "aide:collection:read"})
     * 
     * @ORM\ManyToMany(targetEntity=Variable::class)
     * @ORM\JoinTable(name="api_aide_variable")
     */
    private $variables;

    /**
     * Liste des aides cumulables
     * 
     * @var Collection|Aide[]
     * 
     * @Groups({"aide:item:read"})
     * 
     * @ApiSubresource
     * @ApiProperty(readableLink=false, writableLink=false)
     * 
     * @ORM\ManyToMany(targetEntity=Aide::class)
     * @ORM\JoinTable(name="api_aide_aide")
     */
    private $aidesCumulables;

    /**
     * @var array
     */
    const TYPES = [ 'prime', 'avance' ];

    public function __construct()
    {
        $this->offres = new ArrayCollection();
        $this->valeurs = new ArrayCollection();
        $this->conditions = new ArrayCollection();
        $this->aidesCumulables = new ArrayCollection();
        $this->variables = new ArrayCollection();
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

    public function getRessources(): ?array
    {
        return $this->ressources;
    }

    public function setRessources(?array $ressources): self
    {
        $this->ressources = $ressources;

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

    public function getLogo(): ?Logo
    {
        return $this->logo;
    }

    public function setLogo(?Logo $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function toArrayOffres(): array
    {
        return $this->offres->toArray();
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

    /**
     * @return Collection|Valeur[]
     */
    public function getValeurs(): Collection
    {
        return $this->valeurs;
    }

    public function toArrayValeurs(): array
    {
        return $this->valeurs->toArray();
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

    public function toArrayConditions(): array
    {
        return $this->conditions->toArray();
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

    /**
     * @return Collection|Variable[]
     */
    public function getVariables(): Collection
    {
        return $this->variables;
    }

    public function toArrayVariables(): array
    {
        return $this->variables->getValues();
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

    public function toArrayAidesCumulables(): array
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

}
