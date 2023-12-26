<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\Exception\ORMException;
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

    #[Route('/series', name: 'app_series_index', methods: ['GET'])]
    public function index(): Response
    {
        $series = $this->repository->findAll();
        return $this->render('series/index.html.twig', [
            'series' => $series,
        ]);
    }

    #[Route('/series/create', name: 'app_series_form', methods: ['GET'])]
    public function serieForm(): Response
    {
        return $this->render('series/form.html.twig');
    }

    #[Route('/series/create', name: 'app_series_add', methods: ['POST'])]
    public function addSerie(Request $request): Response
    {
        $this->repository->add(
            new Serie($request->request->get('name')),
            true
        );
        return new RedirectResponse('/series');
    }

    /**
     * @throws ORMException
     */
    #[Route('/series/delete/{id}', name: 'app_series_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->repository->delete($id, true);
        return new RedirectResponse('/series');
    }
}
