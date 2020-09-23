<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      normalizationContext={},
 *      denormalizationContext={},
 *      collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"distributeur:collection:read"}
 *              }
 *          }
 *      },
 *      itemOperations={"get"}
 * )
 * 
 * @ORM\Entity
 * @ORM\Table(name="api_distributeur")
 */
class Distributeur
{
    /**
     * @var int
     * 
     * @Groups({
     *      "distributeur:collection:read",
     *      "aide:collection:read",
     *      "aide:subresource:read"
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
     *      "distributeur:collection:read",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read",
     *      "simulation:item:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @var string|null
     * 
     * @Groups({
     *      "distributeur:collection:read",
     *      "aide:item:read",
     *      "aide:collection:read",
     *      "aide:item:write",
     *      "aide:subresource:read"
     * })
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180)
     */
    private $perimetre = 'FR';

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

    public function getPerimetre(): ?string
    {
        return $this->perimetre;
    }

    public function setPerimetre(?string $perimetre): self
    {
        $this->perimetre = $perimetre ? $perimetre : 'FR';

        return $this;
    }
}