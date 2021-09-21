<?php

namespace App\Modelo;

use App\Entity\Contratos;
use App\Repository\ContratosRepository;
use App\Repository\EmpresasRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class Modelo {

    private UserRepository $ur;
    private EntityManagerInterface $em;
    private ContratosRepository $cr;
    private EmpresasRepository $emr;
    private MailerInterface $mailer;

    public function __construct(UserRepository $ur, 
    EntityManagerInterface $em, 
    ContratosRepository $cr,
    EmpresasRepository $emr,
    MailerInterface $mailer)
    {
        $this->ur = $ur;
        $this->em = $em;
        $this->cr = $cr;
        $this->emr = $emr;
        $this->mailer = $mailer;
    }
    /* EDITAR USUARIO */
    public function guardar(int $id, array $role, string $nombre, string $direccion, string $localidad, string $codigo, string $provincia, string $telefono, string $email)
    {
        $usuario = $this->ur->find($id);
        $usuario->setRoles($role);
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

        $correo = $this->ur->find($ids);
        $correo->getEmail();
        $em_con = $this->emr->find($empresa);
        $em_con->getNombre();

        $email = (new Email())
        ->from($correo)
        ->to($correo)
        ->subject('Contrato por Compara trans')
        ->html('<h2>ComparaTrans</h2>'.
                '<h3>maito@maito.com</h3>'.
                '<h4 style="color:green;">EMPRESA CONTRATADA: '. $em_con .'</h4>'.
                '<h4 style="color:blue;">TRAILERS: '. $trailer .'</h4>'.
                '<h4 style="color:blue;">CAMIONES: '. $camion .'</h4>'.
                '<h4 style="color:blue;">FURGONES: '. $furgon .'</h4>'.
                '<h4 style="color:blue;">MENOS DE 3500K LS: '. $coche .'</h4>'.
                '<br>'.
                '<h4 style="color:green;">PROCEDENCIA: '. $salida .'</h4>'.
                '<h4 style="color:green;">DESTINO: '. $llegada .'</h4>'.
                '<br>'.
                '<h2 style="color:red;">PRECIO: '. $precio .'</h2>'.
                '<br>'.
                '<p>Este correo es <strong>informativo.</strong> En breve se pondran en contacto con usted la empresa que seleciono.</p>');

        $this->mailer->send($email);

        $correoEmpresa = $this->ur->find($empresa);
        $correoEmpresa->getEmail();
        $nom_usu = $this->ur->find($ids);
        $nom_usu->getNombre();

        $emailEmpresa = (new Email())
        ->from($correoEmpresa)
        ->to($correoEmpresa)
        ->subject('Contrato por Compara trans')
        ->html('<h2>ComparaTrans</h2>'.
                '<h3>maito@maito.com</h3>'.
                '<h4 style="color:green;">CLIENTE: '. $nom_usu .'</h4>'.
                '<h4 style="color:blue;">TRAILERS: '. $trailer .'</h4>'.
                '<h4 style="color:blue;">CAMIONES: '. $camion .'</h4>'.
                '<h4 style="color:blue;">FURGONES: '. $furgon .'</h4>'.
                '<h4 style="color:blue;">MENOS DE 3500K LS: '. $coche .'</h4>'.
                '<br>'.
                '<h4 style="color:green;">PROCEDENCIA: '. $salida .'</h4>'.
                '<h4 style="color:green;">DESTINO: '. $llegada .'</h4>'.
                '<br>'.
                '<h2 style="color:red;">PRECIO: '. $precio .'</h2>'.
                '<br>'.
                '<p>Este correo es <strong>informativo.</strong> En breve se pondran en contacto con usted la empresa que seleciono.</p>');

        $this->mailer->send($emailEmpresa);

        return $contrato;
    }

    // editar precios de los vehiculos
    public function editarPrecio($id, $tra, $cam, $fur, $coc)
    {
        $precio = $this->emr->find($id);
        $precio->setPrecioTrailer($tra);
        $precio->setPrecioCamion($cam);
        $precio->setPrecioFurgon($fur);
        $precio->setPrecioCoche($coc);

        try {
            $this->em->persist($precio);
            $this->em->flush();
        } catch (Exception $ex) {
            return 'Error al guardar precio' . $ex->getMessage();
        }

        return $precio;
    }

    // mail de contacto
    public function contactos($nom, $cor, $asu, $men)
    {
        $email = (new Email())
        ->from('prueba.kiko.desarrollo@gmail.com')
        ->to('prueba.kiko.desarrollo@gmail.com')
        ->subject($asu)
        ->html('<p>'. $nom .'</p>'.
                '<p>'. $cor .'</p>'.
                '<p>'. $men .'</p>');

        $this->mailer->send($email);

        return $email;
    }
}