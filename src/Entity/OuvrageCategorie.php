<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"categorie:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"categorie:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"categorie:collection:read"}
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
 * @ORM\Entity
 * @ORM\Table(name="api_ouvrage_categorie")
 */
class OuvrageCategorie
{
    /**
     * @var int
     * 
     * @Groups({
     *      "categorie:item:read",
     *      "categorie:collection:read",
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
     * Nom de la catégorie de travaux
     * 
     * @var string
     * 
     * @Groups({
     *      "categorie:item:read",
     *      "categorie:collection:read",
     *      "categorie:item:write",
     *      "ouvrage:item:read",
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

    public function getId(): ?int
    {
        return $this->id;
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

}
