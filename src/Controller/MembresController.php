<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\MembreTypeForm;
use App\Repository\MembresRepository;
use App\Repository\RankRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MembresController extends AbstractController
{
    #[Route('/membres', name: 'app_membres')]
    public function index(MembresRepository $membresRepository, RankRepository $rankRepository): Response
    {
        $membres = $membresRepository->getAllActif();
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
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $membre = new Membres();

        $form = $this->createForm(MembreTypeForm::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $membre->setIsActif(true);
            $em->persist($membre);
            $em->flush();

            return $this->redirectToRoute('app_membres');
        }

        return $this->render('membres/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/membre/edit/{id}', name: 'app_membre_edit')]
    public function edit(Request $request, EntityManagerInterface $em, int $id, MembresRepository $membresRepository): Response
    {
        $membre = $membresRepository->findOneById($id);

        $form = $this->createForm(MembreTypeForm::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($membre);
            $em->flush();

            return $this->redirectToRoute('app_membres');
        }

        return $this->render('membres/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/membre/del/{id}', name: 'app_membre_del')]
    public function expulser(Request $request, EntityManagerInterface $em, int $id, MembresRepository $membresRepository): Response
    {
        $membre = $membresRepository->findOneById($id);
        $membre->setIsActif(false);

        $em->persist($membre);
        $em->flush();

        return $this->redirectToRoute('app_membres');

    }
}
