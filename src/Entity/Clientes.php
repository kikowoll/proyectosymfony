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
     * @ORM\OneToOne(targetEntity=user::class, cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $fecha;

    /**
     * @ORM\OneToOne(targetEntity=contratos::class, cascade={"persist", "remove"})
     */
    private $contratos;

    /**
     * @ORM\ManyToMany(targetEntity=empresas::class, inversedBy="clientes")
     */
    private $empresas;

    public function __construct()
    {
        $this->empresas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?user
    {
        return $this->usuario;
    }

    public function setUsuario(?user $usuario): self
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

    public function getContratos(): ?contratos
    {
        return $this->contratos;
    }

    public function setContratos(?contratos $contratos): self
    {
        $this->contratos = $contratos;

        return $this;
    }

    /**
     * @return Collection|empresas[]
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(empresas $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
        }

        return $this;
    }

    public function removeEmpresa(empresas $empresa): self
    {
        $this->empresas->removeElement($empresa);

        return $this;
    }
}
