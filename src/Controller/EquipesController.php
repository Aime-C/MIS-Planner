<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EquipesController extends AbstractController
{
    #[Route('/equipes', name: 'app_equipes')]
    public function index(EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findAll();
        $equipesIngenieurs = [];
        foreach ($equipes as $equipe) {
            if($equipe->getTypeEquipe()->getNom() == 'Ingénieurie'){
                $equipesIngenieurs[] = $equipe;
            }
        }
        return $this->render('equipes/index.html.twig', [
            'equipesIngenieurs' => $equipesIngenieurs,
            'equipes' => $equipes,
            'controller_name' => 'EquipesController',
        ]);
    }
    #[Route('/equipes/add', name: 'app_equipes_add')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $action = 'add';
        $equipe = new Equipe();

        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('app_equipes');
        }

        return $this->render('equipes/add.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/equipes/edit/{id}', name: 'app_equipes_edit')]
    public function edit(Request $request, EntityManagerInterface $em, Int $id): Response
    {
        $action='edit';
        $equipe = new Equipe();
        $equipe = $em->getRepository(Equipe::class)->find($id);
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('app_equipes');
        }

        return $this->render('equipes/add.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/equipes/del/{id}', name: 'app_equipes_del')]
    public function delete(EntityManagerInterface $em, Int $id): Response
    {
        $equipe = new Equipe();
        $equipe = $em->getRepository(Equipe::class)->find($id);

        $em->remove($equipe);
        $em->flush();

        return $this->redirectToRoute('app_equipes');
    }

}
