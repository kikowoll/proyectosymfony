<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'pri_')]
class PrincipalController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        

        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
            'textos' => '',
            'colores' => '',
        ]);
    }

    
}
