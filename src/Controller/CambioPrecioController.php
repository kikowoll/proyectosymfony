<?php

namespace App\Controller;

use App\Modelo\Modelo;
use App\Repository\EmpresasRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cambio', name: 'cam_')]
class CambioPrecioController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        EmpresasRepository $empresasRepository): Response
    {
        $usuario = $this->getuser()->getNombre();
        $datosArray = $empresasRepository->verEmpresa($usuario);
        
        dump($datosArray);
        return $this->render('cambio_precio/index.html.twig', [
            'controller_name' => 'CambioPrecioController',
            'datos' => $datosArray,
            'textos' => '',
            'colores' => '',
        ]);
    }

    #[Route('/guardar', name: 'guardar')]
    public function guardar(
        EmpresasRepository $empresasRepository,
        Request $request,
        Modelo $modelo):Response
    {
        $usuario = $this->getuser()->getNombre();
        $array = $empresasRepository->verEmpresa($usuario);
        $datos = $array[0]->getId();
        $trailer = $request->request->get('pre-trailer'); 
        $camion = $request->request->get('pre-camion'); 
        $furgon = $request->request->get('pre-furgon'); 
        $coche = $request->request->get('pre-coche'); 

        $mandar = $modelo->editarPrecio($datos, $trailer, $camion, $furgon, $coche);
        $mandar->getId();
        if($mandar) {
            $texto = 'Datos cambiados con exito';
            $color = 'success';
        } else {
            $texto = 'Error al guardar los datos';
            $color = 'danger';
        }
        
        return $this->render('cambio_precio/index.html.twig', [
            'controller_name' => 'CambioPrecioController',
            'datos' => $array,
            'textos' => $texto,
            'colores' => $color,
        ]);
    }

}
