<?php

namespace App\Controller;

use App\Repository\MembresRepository;
use App\Repository\VaisseauxMembresRepository;
use App\Repository\VaisseauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlotteController extends AbstractController
{
    #[Route('/flotte', name: 'app_flotte')]
    public function index(VaisseauxMembresRepository $vaisseauxMembresRepository, MembresRepository $membresRepository, VaisseauxRepository $vaisseauxRepository): Response
    {
        $vaisseauxMembres = $vaisseauxMembresRepository->findAll();
        $membres = $membresRepository->findAll();
        $vaisseaux = $vaisseauxRepository->findAll();





        $mapped = [];

        foreach ($vaisseauxMembres as $vm) {
            $membre = null;
            $vaisseau = null;

            // Trouver le membre correspondant
            foreach ($membres as $m) {
                if($m->getIsActif() == 1){
                    if ($m->getId() === $vm->getMembreId()) {
                        $membre = $m;
                        break;
                    }
                }
            }

            // Trouver le vaisseau correspondant
            foreach ($vaisseaux as $v) {
                if ($v->getId() === $vm->getVaisseauId()) {
                    $vaisseau = $v;
                    break;
                }
            }

            if ($membre && $vaisseau) {
                $mapped[] = [
                    'membre' => $membre,
                    'vaisseau' => $vaisseau,
                ];
            }
        }

        return $this->render('flotte/index.html.twig', [
            'controller_name' => 'FlotteController',
            'assignations' => $mapped,
        ]);




    }
}
