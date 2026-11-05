<?php

namespace App\Entity;

use App\Repository\TypeCampagneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeCampagneRepository::class)]
class TypeCampagne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nonType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNonType(): ?string
    {
        return $this->nonType;
    }

    public function setNonType(string $nonType): static
    {
        $this->nonType = $nonType;

        return $this;
    }
}
