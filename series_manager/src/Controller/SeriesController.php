<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\Exception\ORMException;
use phpDocumentor\Reflection\Types\This;
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
    public function index(Request $request): Response
    {
        $series = $this->repository->findAll();
        $msg = $request->getSession()->get('success');
        $request->getSession()->remove('success');
        return $this->render('series/index.html.twig', [
            'series' => $series,
            'msg' => $msg,
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
        $request->getSession()->set('success', 'Série adicionada com sucesso!');
        return new RedirectResponse('/series');
    }

    /**
     * @throws ORMException
     */
    #[Route('/series/delete/{id}', name: 'app_series_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(int $id, Request $request): Response
    {
        $this->repository->delete($id, true);
        $request->getSession()->set('success', 'Série removida com sucesso!');
        return new RedirectResponse('/series');
    }

    #[Route('/series/edit/{serie}', name: 'app_series_edit', methods: ['GET'])]
    public function edit(Serie $serie): Response
    {
        return $this->render('series/form.html.twig', compact('serie'));
    }

    #[Route('/series/edit/{serie}', name: 'app_series_update', methods: ['PATCH'])]
    public function update(Serie $serie, Request $request): Response
    {
        $serie->setName($request->request->get('name'));
        $this->repository->add($serie, true);
        $request->getSession()->set('success', 'Série atualizada com sucesso!');
        return new RedirectResponse('/series');
    }
}
