<?php

namespace App\Controller;

use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonController extends AbstractController
{
    #[Route('/serie/{serie}/seasons', name: 'app_season', methods: ['GET'])]
    public function index(Serie $serie): Response
    {
        $seasons = $serie->getSeasons();
        return $this->render('season/index.html.twig', [
            'serie' => $serie,
            'seasons' => $seasons,
        ]);
    }
}
