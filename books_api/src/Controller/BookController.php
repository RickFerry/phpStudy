<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function __construct(private readonly BookRepository $bookRepository)
    {
    }

    #[Route('/books', name: 'list_book', methods: ['GET'])]
    public function findAll(): JsonResponse
    {
        return $this->json([
            'data' => $this->bookRepository->findAll(),
        ]);
    }

    #[Route('/books/{id}', name: 'one_book', methods: ['GET'])]
    public function findOne(int $id): JsonResponse
    {
        $book = $this->bookRepository->find($id);
        if (!$book) throw $this->createNotFoundException('Book not found');

        return $this->json([
            'data' => $book,
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/books', name: 'create_book', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $book = new Book();
        $book->setTitulo($data['title']);
        $book->setIsbn($data['isbn']);
        $book->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));
        $book->setUpdatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));

        $this->bookRepository->save($book, true);
        return $this->json([
            'message' => 'Success!',
        ], 201);
    }
}
