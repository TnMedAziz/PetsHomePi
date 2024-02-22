<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   

    #[ORM\Column(length: 255)]
    private ?string $nomService = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $idtype = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    

   

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): static
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdtype(): ?int
    {
        return $this->idtype;
    }

    public function setIdtype(int $idtype): static
    {
        $this->idtype = $idtype;

        return $this;
    }
}
