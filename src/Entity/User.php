<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("api")
     */
    private $username;

    /**
     * @ORM\ManyToMany(targetEntity=Authority::class, cascade={"persist"})
     * @Groups("api")
     */
    private $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @return Collection|Authority[]
     */
    public function getAuthorities(): Collection
    {
        return new ArrayCollection(array_unique($this->roles->getValues()));
    }

    public function addAuthority(Authority $auth): self
    {
        if (!$this->roles->contains($auth)) {
            $this->roles->add($auth);
        }

        return $this;
    }

    public function removeAuthority(Authority $auth): self
    {
        if ($this->roles->contains($auth)) {
            $this->roles->removeElement($auth);
        }

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->getAuthorities();
        // guarantee every user at least has ROLE_USER
        $base = new Authority();
        $base->setUsername($this->getUsername());
        $base->setAuthority('ROLE_USER');
        $this->addAuthority($base);
        $strings = array();
        for($i=0;$i<sizeof($roles);$i++){
            $obj = $roles[$i];
            $strings[] = $obj->getAuthority();
        }

        return array_unique($strings);
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

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
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
