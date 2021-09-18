<?php

namespace App\Controller;

use App\Repository\ContratosRepository;
use App\Repository\EmpresasRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movimientos', name: 'mo_')]
class MovimientosController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        UserRepository $userRepository,
        ContratosRepository $contratosRepository,
        EmpresasRepository $empresasRepository): Response
    {
        $idd = $this->getUser()->getId();
        $usuario = $userRepository->find($idd);
        $contrato = $contratosRepository->findAll();
        $empresa = $empresasRepository->findAll();

        dump($contrato);

        return $this->render('movimientos/index.html.twig', [
            'controller_name' => 'MovimientosController',
            'usuarios' => $usuario,
            'contratos' => $contrato,
            'empresas' => $empresa,
        ]);
    }
}
