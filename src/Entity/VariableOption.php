<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_variable_option")
 */
class VariableOption
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
     * Texte de l'option
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
     * @Assert\Length(max=100)
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $texte;

    /**
     * Valeur de l'option
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
    private $valeur;

    /**
     * Variable
     * 
     * @var Variable
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Variable::class, inversedBy="options")
     * @ORM\JoinColumn(nullable=false)
     */
    private $variable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(?string $valeur): self
    {
        $this->valeur = \strtoupper($valeur);

        return $this;
    }

    public function getVariable(): ?Variable
    {
        return $this->variable;
    }

    public function setVariable(?Variable $variable): self
    {
        $this->variable = $variable;

        return $this;
    }
}
