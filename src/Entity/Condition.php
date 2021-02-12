<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_condition")
 */
class Condition
{
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:item:read",
     *      "offre:item:read"
     * })
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * 
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Description de la condition
     * 
     * @var string
     * 
     * @Groups({ 
     *      "aide:item:read", 
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write",
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
     * Liste des expressions validant la condition
     * 
     * @var Collection|Expression[]
     * 
     * @Groups({ 
     *      "aide:item:read", 
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write"
     * })
     * 
     * @Assert\Valid
     * 
     * @ORM\ManyToMany(targetEntity=Expression::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="api_condition_expression")
     */
    private $expressions;

    public function __construct()
    {
        $this->expressions = new ArrayCollection();
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

    /**
     * @return Collection|Expression[]
     */
    public function getExpressions(): Collection
    {
        return $this->expressions;
    }

    public function toArrayExpressions(): array
    {
        return $this->expressions->toArray();
    }

    public function addExpression(Expression $expression): self
    {
        if (!$this->expressions->contains($expression)) {
            $this->expressions[] = $expression;
        }

        return $this;
    }

    public function removeExpression(Expression $expression): self
    {
        if ($this->expressions->contains($expression)) {
            $this->expressions->removeElement($expression);
        }

        return $this;
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function isValide(): ?bool
    {
        if ($this->expressions->count() === 0) {
            return null;
        }
        foreach ($this->expressions as $expression) {
            if ($expression->getResponse() === true) {
                return true;
            }
        }
        return false;
    }
}
