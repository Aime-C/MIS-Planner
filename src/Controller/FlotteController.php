<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Entity\VaisseauxMembres;
use App\Form\MembreTypeForm;
use App\Form\VaisseauMembreTypeForm;
use App\Repository\MarquesRepository;
use App\Repository\MembresRepository;
use App\Repository\SizeRepository;
use App\Repository\TypeRepository;
use App\Repository\VaisseauxMembresRepository;
use App\Repository\VaisseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlotteController extends AbstractController
{
    #[Route('/flotte', name: 'app_flotte')]
    public function index(VaisseauxMembresRepository $vaisseauxMembresRepository,
                          MembresRepository $membresRepository,
                          VaisseauxRepository $vaisseauxRepository): Response
    {
        $vaisseauxMembres = $vaisseauxMembresRepository->findAll();
        $membres = $membresRepository->findAll();
        $vaisseaux = $vaisseauxRepository->findAll();

        $mapped = [];

        foreach ($vaisseauxMembres as $vm) {
            $membre = null;
            $vaisseau = null;
            $marqueVaisseau = null;

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
                    'id' => $vm->getId()
                ];
            }
        }

        return $this->render('flotte/index.html.twig', [
            'controller_name' => 'FlotteController',
            'assignations' => $mapped,
        ]);

    }

    #[Route('/flotte/add', name: 'app_flotte_add')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $vaisseauMembre = new VaisseauxMembres();

        $form = $this->createForm(VaisseauMembreTypeForm::class, $vaisseauMembre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vaisseauMembre->setNom("");
            $em->persist($vaisseauMembre);
            $em->flush();

            return $this->redirectToRoute('app_flotte');
        }

        return $this->render('flotte/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/flotte/edit/{id}', name: 'app_flotte_edit')]
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $vaisseauMembre = $em->getRepository(VaisseauxMembres::class)->find($id);

        $form = $this->createForm(VaisseauMembreTypeForm::class, $vaisseauMembre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vaisseauMembre->setNom("");
            $em->persist($vaisseauMembre);
            $em->flush();

            return $this->redirectToRoute('app_flotte');
        }

        return $this->render('flotte/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/flotte/del/{id}', name: 'app_flotte_del')]
    public function delete(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $vaisseauMembre = $em->getRepository(VaisseauxMembres::class)->find($id);

        $em->remove($vaisseauMembre);
        $em->flush();

        return $this->redirectToRoute('app_flotte');

    }
}
