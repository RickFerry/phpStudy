<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    #[Route('/hello-world', name: 'app_hello_world')]
    public function index(Request $request): Response
    {
        return new Response(
            '<h1>Id:</h1>' . $request->query->get('id'),
            200,
            ['Content-Type' => 'text/html']
        );
    }
}
