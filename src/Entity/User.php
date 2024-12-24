<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Cet email est déjà utilisé.")

 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir une adresse email.")
     * @Assert\Email(
     *     message="L'adresse email '{{ value }}' n'est pas une adresse email valide.",
     *     mode="strict"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir un nom d'utilisateur.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le nom d'utilisateur doit avoir au moins {{ limit }} caractères.",
     *     maxMessage="Le nom d'utilisateur ne peut pas dépasser {{ limit }} caractères."
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir un mot de passe.")
     * @Assert\Length(
     *     min=6,
     *     minMessage="Le mot de passe doit avoir au moins {{ limit }} caractères."
     * )
     */
    private $password;

    /**
     * @Assert\NotBlank(message="Veuillez confirmer le mot de passe.")
     * @Assert\EqualTo(
     *     propertyPath="password",
     *     message="Les mots de passe ne correspondent pas."
     * )
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Departement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Pratique::class, mappedBy="user")
     */
    private $pratiques;

    public function __construct()
    {
        $this->pratiques = new ArrayCollection();
    }

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        // Vous pouvez retourner les rôles de l'utilisateur ici
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // Vous n'avez pas besoin de sel si vous utilisez bcrypt ou autre algorithme sécurisé
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // Supprimer les données sensibles de l'utilisateur
        // (par exemple, les données qui pourraient être stockées en session)
    }

    public function getDepartement(): ?string
    {
        return $this->Departement;
    }

    public function setDepartement(string $Departement): self
    {
        $this->Departement = $Departement;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Pratique>
     */
    public function getPratiques(): Collection
    {
        return $this->pratiques;
    }

    public function addPratique(Pratique $pratique): self
    {
        if (!$this->pratiques->contains($pratique)) {
            $this->pratiques[] = $pratique;
            $pratique->setUser($this);
        }

        return $this;
    }

    public function removePratique(Pratique $pratique): self
    {
        if ($this->pratiques->removeElement($pratique)) {
            // set the owning side to null (unless already changed)
            if ($pratique->getUser() === $this) {
                $pratique->setUser(null);
            }
        }

        return $this;
    }
}
