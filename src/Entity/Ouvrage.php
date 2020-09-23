<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OuvrageRepository;
use App\Model\Ouvrage as Simulation;

/**
 * @ApiResource(
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
 * @UniqueEntity(fields={"code"})
 * @ORM\Entity(repositoryClass=OuvrageRepository::class)
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
     *      "offre:item:read",
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
     *      "ouvrage:item:read",
     *      "ouvrage:collection:read",
     *      "ouvrage:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $code;

    /**
     * @var string
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "ouvrage:collection:read",
     *      "ouvrage:item:write",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @var Collection|Offre[]
     * 
     * @Groups({
     *      "ouvrage:item:read",
     *      "simulation:item:read"
     * })
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="ouvrage", cascade={"persist", "remove"})
     */
    private $offres;

    /**
     * @var Simulation|null
     */
    private $simulation;

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

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setOuvrage($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getOuvrage() === $this) {
                $offre->setOuvrage(null);
            }
        }

        return $this;
    }

    public function getSimulation(): ?Simulation 
    {
        return $this->simulation;
    }

    public function setSimulation(?Simulation $simulation): self
    {
        $this->simulation = $simulation;

        return $this;
    }

}
