<?php

namespace App\Entity;

use App\Repository\ContratosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratosRepository::class)
 */
class Contratos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\OneToOne(targetEntity=Empresas::class, cascade={"persist", "remove"})
     */
    private $empresa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salida;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $llegada;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $precio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $trailer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $camion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $furgon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getEmpresa(): ?Empresas
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresas $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getSalida(): ?string
    {
        return $this->salida;
    }

    public function setSalida(?string $salida): self
    {
        $this->salida = $salida;

        return $this;
    }

    public function getLlegada(): ?string
    {
        return $this->llegada;
    }

    public function setLlegada(?string $llegada): self
    {
        $this->llegada = $llegada;

        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTrailer(): ?int
    {
        return $this->trailer;
    }

    public function setTrailer(?int $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getCamion(): ?int
    {
        return $this->camion;
    }

    public function setCamion(?int $camion): self
    {
        $this->camion = $camion;

        return $this;
    }

    public function getFurgon(): ?int
    {
        return $this->furgon;
    }

    public function setFurgon(?int $furgon): self
    {
        $this->furgon = $furgon;

        return $this;
    }

    public function getCoche(): ?int
    {
        return $this->coche;
    }

    public function setCoche(?int $coche): self
    {
        $this->coche = $coche;

        return $this;
    }
}
