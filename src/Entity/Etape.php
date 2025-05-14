<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptif = null;

    #[ORM\Column(length: 255 , nullable: true)]
    private ?string $consigne = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'etape')]
    private ?Parcours $parcours = null;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'etape')]
    private Collection $ressource;

    /**
     * @var Collection<int, Rendu>
     */
    #[ORM\ManyToMany(targetEntity: Rendu::class, inversedBy: 'etapes')]
    private Collection $rendu;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    public function __construct()
    {
        $this->ressource = new ArrayCollection();
        $this->rendu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getConsigne(): ?string
    {
        return $this->consigne;
    }

    public function setConsigne(string $consigne): static
    {
        $this->consigne = $consigne;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): static
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessource(): Collection
    {
        return $this->ressource;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressource->contains($ressource)) {
            $this->ressource->add($ressource);
            $ressource->setEtape($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->ressource->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getEtape() === $this) {
                $ressource->setEtape(null);
            }
        }

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

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }
}
