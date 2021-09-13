<?php

namespace App\Controller;

use App\Repository\EmpresasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/empresas', name: 'em_')]
class EmpresasController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        Request $request,
        EmpresasRepository $empresasRepository
    ): Response
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

        $empresa = $empresasRepository->findAll();

        dump($empresa);

        return $this->render('empresas/index.html.twig', [
            'controller_name' => 'EmpresasController',
            'salidas' => $procedencia,
            'llegadas' => $destino,
            'kilometros' => $kilometro,
            'trailers' => $trailer,
            'camiones' => $camion,
            'furgones' => $furgon,
            'coches' => $coche, 
            'empresas' => $empresa,

        ]);
    }
}
