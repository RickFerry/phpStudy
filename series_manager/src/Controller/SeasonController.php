<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\PersistentCollection;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SeasonController extends AbstractController
{
    public function __construct(private readonly CacheInterface $cache)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    #[Route('/serie/{serie}/seasons', name: 'app_season', methods: ['GET'])]
    public function index(Serie $serie): Response
    {
        $seasons = $this->cache->get(
            "serie_{$serie->getId()}_seasons",
            function (ItemInterface $item) use ($serie) {
                $item->expiresAfter(new \DateInterval('PT10S'));

                /** @var PersistentCollection $seasons */
                $seasons = $serie->getSeasons();
                $seasons->initialize();

                return $seasons;
            }
        );
        return $this->render('season/index.html.twig', [
            'serie' => $serie,
            'seasons' => $seasons,
        ]);
    }
}
