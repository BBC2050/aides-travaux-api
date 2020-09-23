<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"utilisateur:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"utilisateur:item:write"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_SUPER_ADMIN')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_SUPER_ADMIN')",
 *              "denormalizationContext"={
 *                  "groups"={"utilisateur:item:create"}
 *              },
 *              "validationGroups"={"Default", "postValidation"}
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_SUPER_ADMIN') or (is_granted('ROLE_ADMIN') and user.id === object.id)"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_SUPER_ADMIN')"
 *          }
 *      }
 * )
 * 
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"email"})
 * @ORM\Table(name="api_utilisateur")
 */
class Utilisateur implements UserInterface
{
    /**
     * @var int
     * 
     * @Groups({"utilisateur:item:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @Groups({
     *      "utilisateur:item:read",
     *      "utilisateur:collection:read",
     *      "utilisateur:item:create"
     * })
     * @Assert\NotBlank
     * @Assert\Email(mode="loose")
     * @Assert\Length(max=180)
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var array
     * 
     * @Groups({
     *      "utilisateur:item:read",
     *      "utilisateur:collection:read",
     *      "utilisateur:item:create"
     * })
     * @Assert\Type("array")
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * 
     * @Groups({
     *      "utilisateur:item:update",
     *      "utilisateur:item:create"
     * })
     * @Assert\NotBlank(groups={"postValidation"})
     * @Assert\Type("string")
     * @Assert\Length(min=10, max=30)
     */
    private $plainPassword;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
