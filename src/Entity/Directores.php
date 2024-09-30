<?php

namespace App\Entity;

use App\Repository\DirectoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectoresRepository::class)]
class Directores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $fechaNac = null;

    #[ORM\OneToMany(mappedBy: 'director', targetEntity: Peliculas::class)]
    private Collection $peliculas;

    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getFechaNac(): ?string
    {
        return $this->fechaNac;
    }

    public function setFechaNac(string $fechaNac): self
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * @return Collection<int, Peliculas>
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Peliculas $pelicula): self
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas->add($pelicula);
            $pelicula->setDirector($this);
        }

        return $this;
    }

    public function removePelicula(Peliculas $pelicula): self
    {
        if ($this->peliculas->removeElement($pelicula)) {
            // set the owning side to null (unless already changed)
            if ($pelicula->getDirector() === $this) {
                $pelicula->setDirector(null);
            }
        }

        return $this;
    }
}
