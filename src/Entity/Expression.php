<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Resolver\ExpressionLanguageTransformer;
use App\Resolver\ExpressionInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_expression")
 */
class Expression implements ExpressionInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @Assert\Type("string")
     * @Assert\Length(max=240)
     * 
     * @ORM\Column(type="string", length=240)
     */
    private ?string $expression = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(?string $expression): self
    {
        $expression = \preg_replace('/\s+/', ' ', $expression);
        $expression = \str_replace(['===', '!=='], ['==', '<>'], $expression);
        $expression = \str_replace(['=', '!='], ['==', '<>'], $expression);
        $expression = \str_replace(['=>', '=<'], ['>=', '<='], $expression);
        $expression = \str_replace(['( ', ' )'], ['(', ')'], $expression);

        $this->expression = $expression;

        return $this;
    }

    /**
     * @Assert\ExpressionLanguageSyntax(
     *      allowedVariables={"object"}
     * )
     */
    public function getExpressionLanguage(): string
    {
        return ExpressionLanguageTransformer::transform($this->expression);
    }

}
