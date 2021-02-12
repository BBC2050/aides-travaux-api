<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator as AppAssert;
use App\Resolver\ExpressionLanguageTransformer;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_expression")
 */
class Expression
{
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:item:read",
     *      "offre:item:read"
     * })
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Expression
     * 
     * @var string
     * 
     * @Groups({ 
     *      "aide:item:read", 
     *      "aide:item:write",
     *      "offre:item:read",
     *      "offre:item:write"
     * })
     * 
     * @Assert\NotBlank(allowNull=true)
     * @Assert\Type("string")
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expression;

    /**
     * Valeur de l'expression
     * 
     * @var mixed
     */
    private $response;

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
        $expression = \str_replace(['===', '!=='], ['=', '<>'], $expression);
        $expression = \str_replace(['==', '!='], ['=', '<>'], $expression);
        $expression = \str_replace(['=>', '=<'], ['>=', '<='], $expression);
        $expression = \str_replace(['( ', ' )'], ['(', ')'], $expression);

        $this->expression = $expression;

        return $this;
    }

    /**
     * @Assert\All({
     *     @Assert\AtLeastOneOf({
     *          @Assert\Type("numeric"),
     *          @Assert\Type("bool"),
     *          @Assert\Regex("/^(\$\w+)$/"),
     *          @Assert\Regex("/^(=|<|>|<=|>=|<>|&&|and|\|\||or)$/"),
     *          @Assert\Regex("/^(\x22((\w|_)*?)\x22)$/"),
     *     })
     * })
     */
    public function getExpressionPieces(): array
    {
        $expression = \str_replace(['(', ')'], '', $this->expression);
        return $this->expression ? \preg_split('/[\s\(\)]+/', $expression) : [];
    }

    /**
     * @Assert\All({
     *     @AppAssert\ExpressionVariableExists()
     * })
     */
    public function getExpressionVariables(): array
    {
        \preg_match('/(\$\w+)/', $this->expression, $matches);
        return $matches;
    }

    /**
     * @Assert\ExpressionLanguageSyntax()
     */
    public function getExpressionLanguage(): string
    {
        return ExpressionLanguageTransformer::transform($this->expression);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @var mixed
     */
    public function setResponse($response): self
    {
        $this->response = $response;

        return $this;
    }
}
