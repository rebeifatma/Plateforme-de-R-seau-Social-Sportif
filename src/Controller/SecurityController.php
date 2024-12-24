<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils; // Ajoutez cette ligne


use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class  SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, ObjectManager $Manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Créer une nouvelle instance de l'entité User
        $user = new User();

        // Créer le formulaire d'inscription
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe

            $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

            $Manager->persist($user);
            $Manager->flush();
            return $this->redirectToRoute("app_login");
        }



        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/connexion", name="app_login")
     */
    public function login()
    {

        return $this->render('security/login.html.twig');
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
    }
}
