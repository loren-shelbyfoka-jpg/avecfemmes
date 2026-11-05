<?php

namespace App\Entity;

use App\Repository\GroupementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
#[ORM\Entity(repositoryClass: GroupementRepository::class)]
class Groupement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
        /** @var Collection<int, Membre> */
    #[ORM\OneToMany(targetEntity: Membre::class, mappedBy: 'groupement')]
    private Collection $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    /** @return Collection<int, Membre> */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setGroupement($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): static
    {
        if ($this->membres->removeElement($membre) && $membre->getGroupement() === $this) {
            $membre->setGroupement(null);
        }

        return $this;
    }
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
