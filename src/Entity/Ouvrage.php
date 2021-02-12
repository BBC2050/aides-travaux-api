<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=false
 *      },
 *      normalizationContext={
 *          "groups"={"ouvrage:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"ouvrage:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"ouvrage:collection:read"}
 *              }
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      },
 *      itemOperations={
 *          "get",
 *          "put"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      }
 * )
 * 
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={"categorie": "exact", "categorie.nom": "partial", "offres.aide.id": "partial"}
 * )
 * 
 * @UniqueEntity(fields={"code"})
 * 
 * @ORM\Entity
 * @ORM\Table(name="api_ouvrage")
 */
class Ouvrage
{
    /**
     * @var int
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "ouvrage:collection:read",
     *      "simulation:item:read"
     * })
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Code unique de l'ouvrage
     * 
     * @var string
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "ouvrage:item:write",
     *      "ouvrage:collection:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $code;

    /**
     * Nom de l'ouvrage
     * 
     * @var string
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "ouvrage:item:write",
     *      "ouvrage:collection:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * Catégorie
     * 
     * @var OuvrageCategorie
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "ouvrage:item:write",
     *      "ouvrage:collection:read",
     *      "simulation:item:read"
     * })
     * 
     * @Assert\NotBlank
     * 
     * @ORM\ManyToOne(targetEntity=OuvrageCategorie::class)
     */
    private $categorie;

    /**
     * @var Collection|Offre[]
     * 
     * @Groups({"ouvrage:item:read"})
     * 
     * @ORM\ManyToMany(targetEntity=Offre::class, mappedBy="ouvrages")
     */
    private $offres;

    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }

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

    public function getCategorie(): ?OuvrageCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?OuvrageCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function toArrayOffres(): array
    {
        return $this->offres->toArray();
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->addOuvrage($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            $offre->removeOuvrage($this);
        }

        return $this;
    }

}
