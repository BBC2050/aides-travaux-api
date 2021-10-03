<?php

namespace App\Entity;

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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Norme RFC7764
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=2000)
     * 
     * @ORM\Column(type="text")
     */
    private ?string $description = null;

    /**
     * @Assert\NotBlank
     * @Assert\Valid
     * 
     * @ORM\OneToOne(targetEntity=Expression::class, cascade={"persist", "remove"})
     */
    private ?Expression $expression = null;

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

    public function getExpression(): ?Expression
    {
        return $this->expression;
    }

    public function setExpression(?Expression $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    // Méthodes calculées

    public function getVariables(): array
    {
        if ($this->expression) {
            preg_match_all('/\$[A-Z]{1,5}\.\w*/', $this->expression->getExpression(), $matches, PREG_PATTERN_ORDER);
            
            return $matches[0];
        }
        return [];
    }

}
