<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MembresController extends AbstractController
{
    #[Route('/membres', name: 'app_membres')]
    public function index(): Response
    {
        return $this->render('membres/index.html.twig', [
            'controller_name' => 'MembresController',
        ]);
    }
}
