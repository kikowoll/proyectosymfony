<?php

namespace App\Controller;

use App\Repository\DatosLocalesRepository;
use App\Repository\EmpresasRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/comparador', name: 'com_')]
class ComparadorController extends AbstractController
{
    #[Route('/', name: 'comparador')]
    public function index(): Response
    {
        return $this->render('comparador/index.html.twig', [
            'controller_name' => 'ComparadorController',
        ]);
    }

    #[Route('/mostrarCom', name: 'mostrarCom')]
    public function mostrarCom(
        DatosLocalesRepository $datosLocalesRepository,
        Request $request):Response
    {
        $local = $datosLocalesRepository->comunidades();

        if($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            
            return new JsonResponse($local);
        } else {
            return $this->render('comparador/index.html.twig');
        }
    }

    #[Route('/mostrarPro', name: 'mostrarPro')]
    public function mostrarPro(
        DatosLocalesRepository $datosLocalesRepository,
        Request $request):Response
    {
        $recibo = $request->request->get('datos');
        $local = $datosLocalesRepository->ciudades($recibo);

        if($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            
            return new JsonResponse($local);
        } else {
            return $this->render('comparador/index.html.twig');
        }
    }

    #[Route('/mostrarLoc', name: 'mostrarLoc')]
    public function mostrarLoc(
        DatosLocalesRepository $datosLocalesRepository,
        Request $request):Response
    {
        $recibo = $request->request->get('datos');
        $local = $datosLocalesRepository->municipios($recibo);

        if($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            
            return new JsonResponse($local);
        } else {
            return $this->render('comparador/index.html.twig');
        }
    }

}
