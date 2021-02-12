<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_valeur")
 */
class Valeur
{    
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:item:read",
     *      "offre:item:read",
     * })
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Description de la valeur
     * 
     * @var string
     * 
     * @Groups({ 
     *      "aide:item:read",
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write",
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
     * Type de la valeur
     * - montant
     * - plafond 
     * - facteur 
     * - terme
     * 
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write",
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Choice(choices=Valeur::TYPES)
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * Liste des conditions
     * 
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write",
     * })
     * 
     * @Assert\Valid
     * 
     * @ORM\ManyToMany(targetEntity=Condition::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_valeur_condition")
     */
    private $conditions;

    /**
     * Expression à satisfaire
     * 
     * @var Expression
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write",
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Valid
     * 
     * @ORM\OneToOne(targetEntity=Expression::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $expression;

    /**
     * @var array
     */
    const TYPES = [ 'montant', 'plafond', 'facteur', 'terme' ];

    public function __construct()
    {
        $this->conditions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getExpression(): ?Expression
    {
        return $this->expression;
    }

    public function setExpression(?Expression $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

}
