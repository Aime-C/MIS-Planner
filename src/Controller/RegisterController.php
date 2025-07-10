<?php

namespace App\Controller;

use App\Form\RegisterType;
use Couchbase\User as CouchbaseUser;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $newUser = new User();

        $form = $this->createForm(RegisterType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $newUser,
                $newUser->getPassword()
            );
            $newUser->setPassword($hashedPassword);
            $newUser->setIsValid(0);
            $em->persist($newUser);
            $em->flush();

            return $this->redirectToRoute('app_attente');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
