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
 *      attributes={
 *          "pagination_enabled"=false
 *      },
 *      normalizationContext={
 *          "groups"={"variable:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"variable:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"variable:collection:read"}
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
 *              "security"="is_granted('ROLE_SUPER_ADMIN')"
 *          }
 *      }
 * )
 * 
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={"nom": "partial", "type": "exact"}
 * )
 * 
 * @ORM\Entity
 * @ORM\Table(name="api_variable")
 */
class Variable
{
    /**
     * @var int
     * 
     * @Groups({
     *      "variable:collection:read",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "offre:item:read",
     *      "offre:collection:read"
     * })
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nom de la variable
     * 
     * @var string
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "offre:item:read",
     *      "offre:collection:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * @Assert\Regex("/^(\w*?)$/")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * Description de la variable
     * 
     * @var string
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "offre:item:read",
     *      "offre:collection:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * Type de la variable
     * - string
     * - int
     * - bool
     * - float
     * 
     * @var string
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "offre:item:read",
     *      "offre:collection:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(choices=Variable::TYPES)
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * Liste des options disponibles
     * 
     * @var Collection|VariableOptions[]
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "offre:item:read",
     *      "offre:collection:read"
     * })
     * 
     * @Assert\Valid
     * 
     * @ORM\OneToMany(
     *      targetEntity=VariableOption::class,
     *      mappedBy="variable",
     *      cascade={"persist", "remove"},
     *      orphanRemoval=true
     * )
     */
    private $options;

    /**
     * @var array
     */
    const TYPES = [ 'string', 'int', 'bool', 'float' ];

    public function __construct()
    {
        $this->options = new ArrayCollection();
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
        $this->nom = \strtoupper($nom);

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

    /**
     * @return Collection|VariableOption[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function toArrayOptions(): array
    {
        return $this->options->toArray();
    }

    public function addOption(VariableOption $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setVariable($this);
        }

        return $this;
    }

    public function removeOption(VariableOption $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            // set the owning side to null (unless already changed)
            if ($option->getVariable() === $this) {
                $option->setVariable(null);
            }
        }

        return $this;
    }

    public function isOptionsValid(): bool
    {
        if ($this->type !== 'string') {
            return  $this->options->count() !== 0;
        }
        return true;
    }
}
