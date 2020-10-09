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
     * @var string
     * 
     * @Groups({ 
     *      "aide:item:read", 
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank(groups={"postValidation"})
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $groupe;

    /**
     * @var string
     * 
     * @Groups({
     *      "aide:item:read", 
     *      "aide:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\ExpressionLanguageSyntax()
     * @ORM\Column(type="string", length=255)
     */
    private $expression = "null";

    /**
     * @var bool|null
     * 
     * @Groups({"simulation:item:read"})
     */
    private $response;

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

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(?string $groupe): self
    {
        $this->groupe = $groupe;

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

    public function getResponse(): ?bool
    {
        return $this->response;
    }

    public function setResponse(?bool $response): self
    {
        $this->response = $response;

        return $this;
    }
    
}
