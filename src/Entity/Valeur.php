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
    use \App\Traits\HasConditionsTrait;
    
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:item:read",
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
     *      "aide:item:read",
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $description;

    /**
     * @var string|null
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\ExpressionLanguageSyntax()
     * @ORM\Column(type="string", length=255)
     */
    private $expression = "0";

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Choice(choices=Valeur::TYPES)
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var Collection|Condition[]
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @ORM\ManyToMany(targetEntity=Condition::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_valeur_condition")
     */
    private $conditions;

    /**
     * @var float|null
     * 
     * @Groups({"simulation:item:read"})
     */
    private $response;

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

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(?string $expression): self
    {
        $this->expression = $expression;

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

    public function getResponse(): ?float
    {
        return $this->response;
    }

    public function setResponse(?float $response): self
    {
        $this->response = $response;

        return $this;
    }
}
