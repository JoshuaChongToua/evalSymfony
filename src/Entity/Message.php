<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?\DateTime $dateHeure = null;

    #[ORM\ManyToOne(inversedBy: 'message')]
    private ?User $user = null;

    /**
     * @var Collection<int, Rendu>
     */
    #[ORM\ManyToMany(targetEntity: Rendu::class, inversedBy: 'messages')]
    private Collection $rendu;

    public function __construct()
    {
        $this->rendu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTime $dateHeure): static
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Rendu>
     */
    public function getRendu(): Collection
    {
        return $this->rendu;
    }

    public function addRendu(Rendu $rendu): static
    {
        if (!$this->rendu->contains($rendu)) {
            $this->rendu->add($rendu);
        }

        return $this;
    }

    public function removeRendu(Rendu $rendu): static
    {
        $this->rendu->removeElement($rendu);

        return $this;
    }
}
