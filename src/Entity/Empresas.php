<?php

namespace App\Entity;

use App\Repository\EmpresasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpresasRepository::class)
 */
class Empresas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $precioTrailer;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $precioCamion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $precioFurgon;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $precioCoche;




    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrecioTrailer(): ?string
    {
        return $this->precioTrailer;
    }

    public function setPrecioTrailer(?string $precioTrailer): self
    {
        $this->precioTrailer = $precioTrailer;

        return $this;
    }

    public function getPrecioCamion(): ?string
    {
        return $this->precioCamion;
    }

    public function setPrecioCamion(?string $precioCamion): self
    {
        $this->precioCamion = $precioCamion;

        return $this;
    }

    public function getPrecioFurgon(): ?string
    {
        return $this->precioFurgon;
    }

    public function setPrecioFurgon(?string $precioFurgon): self
    {
        $this->precioFurgon = $precioFurgon;

        return $this;
    }

    public function getPrecioCoche(): ?string
    {
        return $this->precioCoche;
    }

    public function setPrecioCoche(?string $precioCoche): self
    {
        $this->precioCoche = $precioCoche;

        return $this;
    }

   

}
