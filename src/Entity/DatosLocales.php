<?php

namespace App\Entity;

use App\Repository\DatosLocalesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DatosLocalesRepository::class)
 */
class DatosLocales
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
    private $comunidad;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $provincia;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $municipio;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $latitud;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $longitud;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $altitud;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComunidad(): ?string
    {
        return $this->comunidad;
    }

    public function setComunidad(?string $comunidad): self
    {
        $this->comunidad = $comunidad;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(?string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    public function setMunicipio(?string $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(?string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(?string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getAltitud(): ?string
    {
        return $this->altitud;
    }

    public function setAltitud(?string $altitud): self
    {
        $this->altitud = $altitud;

        return $this;
    }
}
