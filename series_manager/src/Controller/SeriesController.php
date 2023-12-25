<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    public function __construct(private readonly SerieRepository $repository)
    {
    }

    #[Route('/series', methods: ['GET'])]
    public function index(): Response
    {
        $series = $this->repository->findAll();
        return $this->render('series/index.html.twig', [
            'series' => $series,
        ]);
    }

    #[Route('/series/create', methods: ['GET'])]
    public function serieForm(): Response
    {
        return $this->render('series/form.html.twig');
    }

    #[Route('/series/create', methods: ['POST'])]
    public function addSerie(Request $request): Response
    {
        $this->repository->add(
            new Serie($request->request->get('name')),
            true
        );
        return new RedirectResponse('/series');
    }
}
