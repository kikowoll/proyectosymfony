<?php

namespace App\Modelo;

use App\Entity\Clientes;
use App\Entity\Contratos;
use App\Repository\ClientesRepository;
use App\Repository\ContratosRepository;
use App\Repository\EmpresasRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\TryCatch;

class Modelo {

    private UserRepository $ur;
    private EntityManagerInterface $em;
    private ContratosRepository $cr;
    private ClientesRepository $clr;
    private EmpresasRepository $emr;

    public function __construct(UserRepository $ur, 
    EntityManagerInterface $em, 
    ContratosRepository $cr, 
    ClientesRepository $clr,
    EmpresasRepository $emr)
    {
        $this->ur = $ur;
        $this->em = $em;
        $this->cr = $cr;
        $this->clr = $clr;
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
    public function contrato(int $ids, string $salida, string $llegada, string $precio, int $empresa, string $fecha)
    {

        $contrato = new Contratos();
        $contrato->setSalida($salida);
        $contrato->setLlegada($llegada);
        $contrato->setPrecio($precio);

        try {
            $this->em->persist($contrato);
            $this->em->flush();
        } catch (Exception $ex) {
            return 'Error al guardar contrato' . $ex->getMessage();
        }

        $usuario = $this->ur->find($ids);
        $empresa = $this->emr->find($empresa);

        $idd = $contrato;
        $idd->getId();
        $cliente = new Clientes();
        $cliente->setUsuario($usuario);
        $cliente->setContratos($idd);
        $cliente->addEmpresa($empresa);
        $cliente->setFecha($fecha);

        try {
            $this->em->persist($cliente);
            $this->em->flush();
        } catch (Exception $ex) {
            return 'Error al guardar cliente' . $ex->getMessage();
        }

        return $contrato;
    }

}