<?php

namespace App\Controller;

use App\Entity\Vaisseaux;
use App\Entity\VaisseauxMembres;
use App\Form\VaisseauMembreTypeForm;
use App\Form\VaisseauTypeForm;
use App\Repository\MarquesRepository;
use App\Repository\SizeRepository;
use App\Repository\TypeRepository;
use App\Repository\VaisseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrganisationController extends AbstractController
{
    #[Route('/organisation', name: 'app_organisation')]
    public function index(): Response
    {
        return $this->render('organisation/index.html.twig', [
            'controller_name' => 'OrganisationController',
        ]);
    }

    #[Route('/organisation/vaisseaux', name: 'app_organisationVaisseaux')]
    public function organisationVaisseaux(MarquesRepository $marquesRepository ,VaisseauxRepository $vaisseauxRepository, SizeRepository $sizeRepository, TypeRepository $typeRepository): Response
    {
        $sizes = $sizeRepository->findAll();
        $vaisseaux = $vaisseauxRepository->findBy([], ['nom' => 'ASC']);
        $marques = $marquesRepository->findAll();
        $types = $typeRepository->findAll();

        return $this->render('organisation/donnees/vaisseaux.html.twig', [
            'controller_name' => 'OrganisationDonnees',
            'vaisseaux' => $vaisseaux,
            'sizes' => $sizes,
            'marques' => $marques,
            'types' => $types,

        ]);
    }

    #[Route('/organisation/vaisseaux/add', name: 'app_organisationDoneesAdd')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $vaisseau = new Vaisseaux();

        $form = $this->createForm(VaisseauTypeForm::class, $vaisseau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vaisseau->setImage("");
            $em->persist($vaisseau);
            $em->flush();

            return $this->redirectToRoute('app_organisationVaisseaux');
        }

        return $this->render('organisation/donnees/add.html.twig', [
            'form' => $form->createView(),
            'isModify' => false,
        ]);
    }

    #[Route('/organisation/vaisseaux/edit/{id}', name: 'app_organisationDoneesEdit')]
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $vaisseau = $em->getRepository(Vaisseaux::class)->find($id);

        $form = $this->createForm(VaisseauTypeForm::class, $vaisseau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vaisseau->setImage("");
            $em->persist($vaisseau);
            $em->flush();

            return $this->redirectToRoute('app_organisationVaisseaux');
        }

        return $this->render('organisation/donnees/add.html.twig', [
            'form' => $form->createView(),
            'isModify' => true,
        ]);
    }
}
