<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @UniqueEntity(fields={"code"})
 * @ORM\Entity
 * @ORM\Table(name="api_secteur")
 */
class Secteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['secteur:read'])]
    private ?int $id = null;

    /**
     * Code interne
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['secteur:read', 'secteur:write'])]
    private ?string $code = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['secteur:read', 'secteur:write'])]
    private ?string $nom = null;

    /**
     * Secteur parent
     * 
     * @ORM\ManyToOne(targetEntity=Secteur::class)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    #[Groups(groups: ['secteur:write'])]
    private ?Secteur $parent = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getParent(): ?Secteur
    {
        return $this->parent;
    }

    public function setParent(?Secteur $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

}
