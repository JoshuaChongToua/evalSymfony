<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'parcours')]
    private Collection $users;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'parcours')]
    private Collection $eta�pe;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->eta�pe = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setParcours($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getParcours() === $this) {
                $user->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEta�pe(): Collection
    {
        return $this->eta�pe;
    }

    public function addEtaPe(Etape $etaPe): static
    {
        if (!$this->eta�pe->contains($etaPe)) {
            $this->eta�pe->add($etaPe);
            $etaPe->setParcours($this);
        }

        return $this;
    }

    public function removeEtaPe(Etape $etaPe): static
    {
        if ($this->eta�pe->removeElement($etaPe)) {
            // set the owning side to null (unless already changed)
            if ($etaPe->getParcours() === $this) {
                $etaPe->setParcours(null);
            }
        }

        return $this;
    }

}
