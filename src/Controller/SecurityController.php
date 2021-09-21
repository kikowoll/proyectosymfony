<?php

namespace App\Controller;

use App\Modelo\Modelo;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     *  @Route("/editar", name="app_editar")
     */
    public function editar(UserRepository $userRepository):Response
    {
        $usuario = $this->getUser();
        $texto = 'Para cambiar tus datos pulsa editar o de lo contrario salir.';

        dump($usuario);

        return $this->render('security/editar.html.twig', [
            'usuarios' => $usuario,
            'texto' => $texto,
            'color' => 'warning',
        ]);
    }

    /**
     *  @Route("/guardar", name="app_guardar")
     */
    public function guardar(
        Request $request,
        UserRepository $userRepository,
        Modelo $modelo):Response
    {
        $idd = $request->request->get('idd');
        $nombre = $request->request->get('nombre');
        $direccion = $request->request->get('direccion');
        $localidad = $request->request->get('localidad');
        $codigo = $request->request->get('codigo');
        $provincia = $request->request->get('provincia');
        $telefono = $request->request->get('telefono');
        $email = $request->request->get('email');
        $soyem = $request->request->get('soyem');

        if(!$soyem) {
            $role = array('[]');
        } else {
            $role = array('["ROLE_ADMIN"]');
        }

        dump($role);

        $cambio = $modelo->guardar(intval($idd),$role,$nombre,$direccion,$localidad,$codigo,$provincia,$telefono,$email);
        $cambio->getId();

        if($cambio) {
            $texto = 'Datos guardados con exito';
            $color = 'success';
        } else {
            $texto = 'Error al guardar los datos.';
            $color = 'danger';
        }

        return $this->render('security/editar.html.twig', [
            'usuarios' => $cambio,
            'texto' =>  $texto,
            'color' => $color,
        ]);
    }
}
