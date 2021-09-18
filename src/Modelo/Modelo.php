<?php

namespace App\Modelo;

use App\Entity\Clientes;
use App\Entity\Contratos;
use App\Repository\ContratosRepository;
use App\Repository\EmpresasRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\ORM\EntityManagerInterface;

class Modelo {

    private UserRepository $ur;
    private EntityManagerInterface $em;
    private ContratosRepository $cr;
    private EmpresasRepository $emr;

    public function __construct(UserRepository $ur, 
    EntityManagerInterface $em, 
    ContratosRepository $cr,
    EmpresasRepository $emr)
    {
        $this->ur = $ur;
        $this->em = $em;
        $this->cr = $cr;
        $this->emr = $emr;
    }
    /* EDITAR USUARIO */
    public function guardar(int $id, string $nombre, string $direccion, string $localidad, string $codigo, string $provincia, string $telefono, string $email)
    {
        $usuario = $this->ur->find($id);
        $usuario->setNombre($nombre);
        $usuario->setDireccion($direccion);
        $usuario->setLocalidad($localidad);
        $usuario->setCodigoPostal($codigo);
        $usuario->setProvincia($provincia);
        $usuario->setTelefono($telefono);
        $usuario->setEmail($email);

        try {
            $this->em->persist($usuario);
            $this->em->flush();
        } catch (Exception $ex) {
            return 'Error al guardar ' . $ex->getMessage();
        }

        return $usuario;
    }

    /* CONTRATAR */
    public function contrato($ids, string $salida, string $llegada, string $precio, $empresa, string $fecha, $trailer, $camion, $furgon, $coche)
    {

        $contrato = new Contratos();
        $contrato->setUsuario($ids);
        $contrato->setEmpresa($empresa);
        $contrato->setSalida($salida);
        $contrato->setLlegada($llegada);
        $contrato->setFecha($fecha);
        $contrato->setPrecio($precio);
        $contrato->setTrailer($trailer);
        $contrato->setCamion($camion);
        $contrato->setFurgon($furgon);
        $contrato->setCoche($coche);

        try {
            $this->em->persist($contrato);
            $this->em->flush();
        } catch (Exception $ex) {
            return 'Error al guardar contrato' . $ex->getMessage();
        }

        return $contrato;
    }
}