<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    #[Route('/series', methods: ['GET'])]
    public function index(): Response
    {
        $series = [
            'Loki',
            'Suits',
            'Super Girl',
            'The Flash',
            'The Walking Dead'
        ];
        return $this->render('series/index.html.twig', [
            'series' => $series,
        ]);
    }

    #[Route('/series/create', methods: ['GET'])]
    public function addSeries(): Response
    {
        return $this->render('series/form.html.twig');
    }
}
