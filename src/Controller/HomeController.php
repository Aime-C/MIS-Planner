<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/attente', name: 'app_attente')]
    #[IsGranted('ROLE_ATTENTE')]
    public function attente(): Response
    {
        return $this->render('page_attente.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
