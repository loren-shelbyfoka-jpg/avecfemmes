<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre extends User
{
    #[ORM\Column(length: 50)]
    private ?string $fonction = null;

    #[ORM\ManyToOne(inversedBy: 'membres')]
    private ?Groupement $groupement = null;

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

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
}