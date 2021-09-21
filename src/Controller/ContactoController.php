<?php

namespace App\Controller;

use App\Modelo\Modelo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contacto', name: 'con_')]
class ContactoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('contacto/index.html.twig', [
            'controller_name' => 'ContactoController',
            'textos' => '',
            'colores' => '',
        ]);
    }

    #[Route('/mandar', name: 'mandar')]
    public function mandar(
        Request $request,
        MailerInterface $mailerInterface,
        Modelo $modelo): Response
    {

        $nombre = $request->request->get('nombre');
        $correo = $request->request->get('correo');
        $asunto = $request->request->get('asunto');
        $mensaje = $request->request->get('mensaje');

        $email = $modelo->contactos($nombre, $correo, $asunto, $mensaje);

        if($email) {
            $texto = 'ENHORABUENA... Tu sugerencia a sido enviada. Pronto nos pondremos en contacto contigo.';
            $color = 'success';
            $sitio = 'principal/index.html.twig';
        } else {
            $texto = 'ERROR al enviar tu sugerencia.';
            $color = 'danger';
            $sitio = 'contacto/index.html.twig';
        }

        return $this->render($sitio, [
            'controller_name' => 'ContactoController',
            'textos' => $texto,
            'colores' => $color,
        ]);

    }
}
