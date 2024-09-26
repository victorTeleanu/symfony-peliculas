<?php

namespace App\Entity;

use App\Repository\PeliculasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeliculasRepository::class)]
class Peliculas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 4)]
    private ?string $anyoEstreno = null;

    #[ORM\Column(length: 255)]
    private ?string $genero = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAnyoEstreno(): ?string
    {
        return $this->anyoEstreno;
    }

    public function setAnyoEstreno(string $anyoEstreno): self
    {
        $this->anyoEstreno = $anyoEstreno;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }
}
