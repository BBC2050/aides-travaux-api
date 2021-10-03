<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ActionRepository;

/**
 * @UniqueEntity(fields={"code"})
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 * @ORM\Table(name="api_action")
 */
class Action
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['action:read'])]
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
    #[Groups(groups: ['action:read', 'action:write'])]
    private ?string $code = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    #[Groups(groups: ['action:read', 'action:write'])]
    private ?string $nom = null;

    /**
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=ActionCategorie::class)
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    #[Groups(groups: ['secteur:read', 'action:write'])]
    private ?ActionCategorie $categorie = null;

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

    public function getCategorie(): ?ActionCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ActionCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

}
