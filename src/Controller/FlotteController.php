<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlotteController extends AbstractController
{
    #[Route('/flotte', name: 'app_flotte')]
    public function index(): Response
    {
        return $this->render('flotte/index.html.twig', [
            'controller_name' => 'FlotteController',
        ]);
    }
}
