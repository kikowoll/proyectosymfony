<?php

namespace App\Controller;

use App\Modelo\Modelo;
use App\Repository\UserRepository;
use App\Repository\EmpresasRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/contratar', name: 'contratar')]
    public function contratar(
        Request $request,
        Modelo $modelo,
        UserRepository $userRepository,):Response
    {
        
        $user = $this->getUser()->getId();
        $empresa = $request->request->get('empresa');

        $trailer = $request->request->get('trailer');
        $camion = $request->request->get('camion');
        $furgon = $request->request->get('furgon');
        $coche = $request->request->get('coche');

        $salida = $request->request->get('salida');
        $llegada = $request->request->get('llegada');

        $precio = $request->request->get('precio');

        $mes = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $meses = $mes[date('n')]; 
        $dia = date('j');
        $ano = date('Y');
        $hora = date('G:i');
        $fecha = $dia .' de ' . $meses .' del ' . $ano . ' - ' . $hora;

        $contrato = $modelo->contrato($user, $salida, $llegada, $precio, $empresa, $fecha);
        $contrato->getId();

        if($contrato) {
            $texto = 'Enhorabuena... Tu seleción esta siendo transferida y en breve la empresa que selecionastes se pondra en contacto con usted.<br> GRACIAS por contar con nosotros y bla bla bla y bla.';
            $color = 'success';
            $sitio = 'principal/index.html.twig';
        } else {
            $texto = 'A pasado algo malo, no hemos podido hacer tu transferencia. Intenalo mas tarde';
            $color = 'danger';
            $sitio = 'comparador/index.html.twig';
        }

        return $this->render($sitio, [
            'textos' => $texto,
            'colores' => $color,
        ]);
    }
}
