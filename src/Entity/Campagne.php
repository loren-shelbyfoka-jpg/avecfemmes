<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateDebut = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\ManyToOne(inversedBy: 'campagnes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeCampagne $type = null;
        /** @var Collection<int, ModeCotisation> */
    #[ORM\OneToMany(targetEntity: ModeCotisation::class, mappedBy: 'campagne', orphanRemoval: true)]
    private Collection $modesCotisation;

    public function __construct()
    {
        $this->modesCotisation = new ArrayCollection();
    }

    /** @return Collection<int, ModeCotisation> */
    public function getModesCotisation(): Collection
    {
        return $this->modesCotisation;
    }

    public function addModeCotisation(ModeCotisation $mode): static
    {
        if (!$this->modesCotisation->contains($mode)) {
            $this->modesCotisation->add($mode);
            $mode->setCampagne($this);
        }

        return $this;
    }
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

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(?Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }

    public function getType(): ?TypeCampagne
    {
        return $this->type;
    }

    public function setType(?TypeCampagne $type): static
    {
        $this->type = $type;

        return $this;
    }
}