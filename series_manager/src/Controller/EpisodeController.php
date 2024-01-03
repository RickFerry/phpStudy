<?php

namespace App\Controller;

use App\Entity\Season;
use App\Repository\EpisodeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends AbstractController
{
    public function __construct(private readonly EpisodeRepository $repository)
    {
    }

    #[Route('/season/{season}/episode', name: 'app_episode', methods: ['GET'])]
    public function index(Season $season): Response
    {
        return $this->render('episode/index.html.twig', [
            'season' => $season,
            'serie' => $season->getSerie(),
            'episodes' => $season->getEpisodes(),
        ]);
    }

    #[Route('/season/{season}/episode', name: 'app_watch_episode', methods: ['POST'])]
    public function watched(Season $season, Request $request): Response
    {
        $watcheds = array_keys($request->request->all('episode'));
        $episodes = $season->getEpisodes();
        foreach ($episodes as $episode) {
            $episode->setWatched(in_array($episode->getId(), $watcheds));
        }
        $this->repository->flush();
        return new RedirectResponse('/season/' . $season->getId() . '/episode');
    }
}
