<?php

namespace App\Entity;

use App\Repository\ContratosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=clientes::class, mappedBy="contratos")
     */
    private $cliente;

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

    public function __construct()
    {
        $this->cliente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|clientes[]
     */
    public function getCliente(): Collection
    {
        return $this->cliente;
    }

    public function addCliente(clientes $cliente): self
    {
        if (!$this->cliente->contains($cliente)) {
            $this->cliente[] = $cliente;
            $cliente->setContratos($this);
        }

        return $this;
    }

    public function removeCliente(clientes $cliente): self
    {
        if ($this->cliente->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getContratos() === $this) {
                $cliente->setContratos(null);
            }
        }

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
