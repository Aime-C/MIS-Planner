<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Repository\MembresRepository;
use App\Repository\RankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MembresController extends AbstractController
{
    #[Route('/membres', name: 'app_membres')]
    public function index(MembresRepository $membresRepository, RankRepository $rankRepository): Response
    {
        $membres = $membresRepository->getAll();
        $ranks = [];
        foreach ($membres as $membre) {
            $ranks = $rankRepository->getAll();
        }

        return $this->render('membres/index.html.twig', [
            'controller_name' => 'MembresController',
            'membres' => $membres,
            'ranks' => $ranks,
        ]);
    }
    #[Route('/membre/add', name: 'app_membre_add')]
    public function add(MembresRepository $membresRepository, RankRepository $rankRepository): Response
    {
        $ranks = $rankRepository->getAll();
        $membre = new Membres();
        return $this->render('membres/add.html.twig', [
            'controller_name' => 'MembresController',
            'membre' => $membre,
            'ranks' => $ranks,
        ]);
    }
}
