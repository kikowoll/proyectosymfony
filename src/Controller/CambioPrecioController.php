<?php

namespace App\Controller;

use App\Repository\EmpresasRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cambio', name: 'cam')]
class CambioPrecioController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        EmpresasRepository $empresasRepository,
        UserRepository $userRepository): Response
    {
        $usuario = $this->getuser()->getId();
        $nombre = $userRepository->find($usuario);
        
        return $this->render('cambio_precio/index.html.twig', [
            'controller_name' => 'CambioPrecioController',
        ]);
    }
}
