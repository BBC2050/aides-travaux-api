<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\VariableRepository;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"variable:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"variable:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"variable:collection:read"}
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
 *          }
 *      }
 * )
 * 
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={
 *          "aides.id": "exact",
 *          "offres.aide": "exact",
 *          "offres.ouvrage": "exact"
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=VariableRepository::class)
 * @ORM\Table(name="api_variable")
 */
class Variable
{
    /**
     * @var int
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "aide:item:read"
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
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @var string
     * 
     * @Groups({
     *      "variable:item:read",
     *      "variable:collection:read",
     *      "variable:item:write",
     *      "aide:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $description;

    /**
     * @var Collection|Aide[]
     * 
     * @ORM\ManyToMany(targetEntity=Aide::class, mappedBy="variables")
     */
    private $aides;

    /**
     * @var Collection|Offre[]
     * 
     * @ORM\ManyToMany(targetEntity=Offre::class, mappedBy="variables")
     */
    private $offres;

    public function __construct()
    {
        $this->aides = new ArrayCollection();
        $this->offres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAides(): Collection
    {
        return $this->aides;
    }

    public function getOffres(): Collection
    {
        return $this->offres;
    }

}
