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

    #[Route('/empresas', name: 'empresas')]
    public function empresas(
        Request $request,
        EmpresasRepository $empresasRepository   
    ):Response
    {
        $trailer = $request->request->get('se-trailer');
        $camion = $request->request->get('se-camion');
        $furgon = $request->request->get('se-furgon');
        $coche = $request->request->get('se-coche');

        $proSalida = $request->request->get('pro-salida');
        $locSalida = $request->request->get('local-salida');
        $proLlegada = $request->request->get('pro-llegada');
        $locLlegada = $request->request->get('local-llegada');

        $kilometro = $request->request->get('kilos');

        $procedencia = $locSalida .' (' . $proSalida .')';
        $destino = $locLlegada .' (' . $proLlegada .')';

        //$empresa = 'hola';//$empresasRepository->findAll();

        return $this->render('comparador/empresas.html.twig', [
            'salidas' => $procedencia,
            'llegadas' => $destino,
            'kilometros' => $kilometro,
            'trailers' => $trailer,
            'camiones' => $camion,
            'furgones' => $furgon,
            'coches' => $coche, 
        ]);
    }
}
