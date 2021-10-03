<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @UniqueEntity(fields={"code"})
 * @ORM\Entity
 * @ORM\Table(name="api_variable")
 */
class Variable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['variable:read'])]
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['variable:read', 'variable:write'])]
    private ?string $categorie = null;

    /**
     * Code interne - $CAT.nom_variable
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * @Assert\Regex("/^\$[A-Z]{1,5}\.(\w*?)$/")
     * 
     * @ORM\Column(type="string", length=40)
     */
    #[Groups(groups: ['variable:read', 'variable:write'])]
    private ?string $code = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(groups: ['variable:read', 'variable:write'])]
    private ?string $description = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Choice(choices=Variable::TYPES)
     * 
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(groups: ['variable:read', 'variable:write'])]
    private ?string $type = null;

    /**
     * Liste des types de variables autorisés
     * 
     * @var array
     */
    const TYPES = [ 'string', 'int', 'bool', 'float' ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

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

    public function isGlobale(): ?bool
    {
        if ($this->code) {
            return \in_array(\substr($this->code, 0, 2), ['$L', '$F']);
        }
        return null;
    }

}
