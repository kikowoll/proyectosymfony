<?php

namespace App\Modelo;

use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\ORM\EntityManagerInterface;

class Modelo {

    private UserRepository $ur;
    private EntityManagerInterface $em;

    public function __construct(UserRepository $ur, EntityManagerInterface $em)
    {
        $this->ur = $ur;
        $this->em = $em;
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
}