<?php

namespace App\Controller;

use App\DTO\SerieCreateFormInput;
use App\Entity\Episode;
use App\Entity\Season;
use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    public function __construct(private readonly SerieRepository $repository)
    {
    }

    #[Route('/series', name: 'app_series_index', methods: ['GET'])]
    public function index(): Response
    {
        $series = $this->repository->findAll();
        return $this->render('series/index.html.twig', [
            'series' => $series
        ]);
    }

    #[Route('/series/create', name: 'app_series_form', methods: ['GET'])]
    public function serieForm(): Response
    {
        $form = $this->createForm(SerieType::class, new SerieCreateFormInput());
        return $this->render('series/form.html.twig', compact('form'));
    }

    #[Route('/series/create', name: 'app_series_add', methods: ['POST'])]
    public function addSerie(Request $request): Response
    {
        $input = new SerieCreateFormInput();
        $handleRequest = $this->createForm(SerieType::class, $input)->handleRequest($request);
        if (!$handleRequest->isValid()) {
            return $this->render('series/form.html.twig', compact('handleRequest'));
        }
        $this->repository->add($this->getSerie($input), true);
        $this->addFlash('success', 'Série adicionada com sucesso!');
        return new RedirectResponse('/series');
    }

    /**
     * @throws ORMException
     */
    #[Route('/series/delete/{id}', name: 'app_series_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->repository->delete($id, true);
        $this->addFlash('success', 'Série removida com sucesso!');
        return new RedirectResponse('/series');
    }

    #[Route('/series/edit/{serie}', name: 'app_series_edit', methods: ['GET'])]
    public function edit(Serie $serie): Response
    {
        $form = $this->createForm(SerieType::class, $serie, ['is_edit' => true]);
        return $this->render('series/form.html.twig', compact('form', 'serie'));
    }

    #[Route('/series/edit/{serie}', name: 'app_series_update', methods: ['PATCH'])]
    public function update(Serie $serie, Request $request): Response
    {
        $form = $this->createForm(SerieType::class, $serie, ['is_edit' => true])->handleRequest($request);
        if (!$form->isValid()) {
            return $this->render('series/form.html.twig', compact('form', 'serie'));
        }
        $this->repository->add($serie, true);
        $this->addFlash('success', 'Série atualizada com sucesso!');
        return new RedirectResponse('/series');
    }

    /**
     * @param SerieCreateFormInput $input
     * @return Serie
     */
    private function getSerie(SerieCreateFormInput $input): Serie
    {
        $serie = new Serie($input->serieName);
        for ($i = 1; $i <= $input->seasonsQuantity; $i++) {
            $season = new Season($i);
            for ($j = 1; $j <= $input->episodesPerSeason; $j++) {
                $season->addEpisode(new Episode($j));
            }
            $serie->addSeason($season);
        }
        return $serie;
    }
}
