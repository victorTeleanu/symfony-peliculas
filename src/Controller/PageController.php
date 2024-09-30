<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Peliculas;

class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/peliculas/insertar/{nombre}/{anyoEstreno}/{genero}', name: 'insertar')]
    public function insertar(ManagerRegistry $doctrine, $nombre, $anyoEstreno, $genero): Response
    {
        $entityManager = $doctrine->getManager();
        $pelicula = new Peliculas();
        $pelicula->setNombre($nombre);
        $pelicula->setAnyoEstreno($anyoEstreno);
        $pelicula->setGenero($genero);

        // Persistir la entidad en la base de datos
        $entityManager->persist($pelicula);

        try {
            $entityManager->flush();
            return new Response('Película insertada con éxito');
        } catch (\Exception $e) {
            return new Response('Error insertando la película: ' . $e->getMessage());
        }
    }

    #[Route('/peliculas/buscar/{id}', name: 'buscar_pelicula')]
    public function buscar(ManagerRegistry $doctrine, $id): Response
    {
        $repositorio = $doctrine->getRepository(Peliculas::class);
        $peliculas = $repositorio->find($id);
        return $this->render('page/buscar.html.twig', [
            'peliculas' => $peliculas
        ]);
    }

    #[Route('/peliculas/{buscar}', name: 'buscar_peliculas')]
    public function buscarPelicula(ManagerRegistry $doctrine, $texto): Response{
        $repositorio = $doctrine->getRepository(Peliculas::class);
        $peliculas = $repositorio->findByName($texto);
        return $this->render('page/buscar.html.twig', [
            'peliculas' => $peliculas
        ]);
    }
}
