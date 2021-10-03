<?php

namespace App\Entity;

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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private ?string $description = null;

    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices=Valeur::TYPES)
     * 
     * @ORM\Column(type="string", length=255)
     */
    private ?string $type = null;

    /**
     * Application de la valeur à l'échelle du dispositif
     * 
     * @Assert\Type("bool")
     * 
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $globale = null;

    /**
     * @Assert\Valid
     * 
     * @ORM\OneToOne(targetEntity=Expression::class, cascade={"persist", "remove"})
     */
    private ?Expression $condition = null;

    /**
     * @Assert\NotBlank
     * @Assert\Valid
     * 
     * @ORM\OneToOne(targetEntity=Expression::class, cascade={"persist", "remove"})
     */
    private ?Expression $expression = null;

    /**
     * @var array
     */
    const TYPES = [
        'montant', 'plafond', 'plancher', 'ecretement', 'depenses', 'facteur', 'terme'
    ];

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

    public function getGlobale(): ?bool
    {
        return $this->globale;
    }

    public function setGlobale(?bool $globale): self
    {
        $this->globale = $globale;

        return $this;
    }

    public function getCondition(): ?Expression
    {
        return $this->condition;
    }

    public function setCondition(?Expression $condition): self
    {
        $this->condition = $condition;

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
        $variables = [];

        if ($this->expression) {
            preg_match_all('/\$[A-Z]{1,5}\.\w*/', $this->expression->getExpression(), $matches, PREG_PATTERN_ORDER);
            $variables = \array_merge($variables, $matches[0]);
        }
        if ($this->condition) {
            preg_match_all('/\$[A-Z]{1,5}\.\w*/', $this->condition->getExpression(), $matches, PREG_PATTERN_ORDER);
            $variables = \array_merge($variables, $matches[0]);
        }
        return \array_values(\array_unique($variables));
    }

}
