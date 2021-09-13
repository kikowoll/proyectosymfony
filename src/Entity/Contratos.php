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
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
