<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @UniqueEntity(fields={"email"})
 * 
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="api_utilisateur")
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(groups: ['utilisateur:read'])]
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     * @Assert\Email(mode="loose")
     * @Assert\Length(max=180)
     * 
     * @ORM\Column(type="string", length=180, unique=true)
     */
    #[Groups(groups: ['utilisateur:read', 'utilisateur:write'])]
    private ?string $email = '';

    /**
     * @Assert\Type("array")
     * 
     * @ORM\Column(type="json")
     */
    #[Groups(groups: ['utilisateur:read', 'utilisateur:write'])]
    private ?array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private ?string $password = '';

    /**
     * @Assert\NotBlank(groups={"postValidation"})
     * @Assert\Type("string")
     * @Assert\Length(min=10, max=30)
     */
    #[Groups(groups: ['utilisateur:write'])]
    private ?string $plainPassword = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function getUserIdentifier(): ?string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
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
