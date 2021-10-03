<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields={"code", "secteur"})
 * @ORM\Entity
 * @ORM\Table(name="api_action_categorie")
 */
class ActionCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['categorie:read'])]
    private ?int $id = null;

    /**
     * Code interne de l'action
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['categorie:read', 'categorie:write'])]
    private ?string $code = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['categorie:read', 'categorie:write'])]
    private ?string $nom = null;

    /**
     * Secteur d'application
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=Secteur::class)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    #[Groups(groups: ['secteur:read', 'categorie:write'])]
    private ?Secteur $secteur = null;

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

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

}
