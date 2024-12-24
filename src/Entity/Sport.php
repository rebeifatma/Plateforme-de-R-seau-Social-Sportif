<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Pratique::class, mappedBy="sport")
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

    public function getNomSport(): ?string
    {
        return $this->nomSport;
    }

    public function setNomSport(string $nomSport): self
    {
        $this->nomSport = $nomSport;

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
            $pratique->setSport($this);
        }

        return $this;
    }

    public function removePratique(Pratique $pratique): self
    {
        if ($this->pratiques->removeElement($pratique)) {
            // set the owning side to null (unless already changed)
            if ($pratique->getSport() === $this) {
                $pratique->setSport(null);
            }
        }

        return $this;
    }
}
