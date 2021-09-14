<?php

namespace App\Entity;

use App\Repository\ClientesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientesRepository::class)
 */
class Clientes
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToMany(targetEntity=Empresas::class, inversedBy="clientes")
     */
    private $empresas;

    /**
     * @ORM\ManyToOne(targetEntity=Contratos::class, inversedBy="cliente")
     */
    private $contratos;

    public function __construct()
    {
        $this->empresas = new ArrayCollection();
    }

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


    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return Collection|Empresas[]
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresas $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
        }

        return $this;
    }

    public function removeEmpresa(Empresas $empresa): self
    {
        $this->empresas->removeElement($empresa);

        return $this;
    }

    public function getContratos(): ?Contratos
    {
        return $this->contratos;
    }

    public function setContratos(?Contratos $contratos): self
    {
        $this->contratos = $contratos;

        return $this;
    }
}
