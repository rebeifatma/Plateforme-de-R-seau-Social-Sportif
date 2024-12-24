<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    /**
     * @Route("/create_sport", name="create_sport")
     */
    public function createSport(Request $request): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajoutez ici la logique pour sauvegarder l'entité dans la base de données
            // par exemple, utilisez Doctrine EntityManager pour persister l'entité

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sport);
            $entityManager->flush();

            // Ajoutez un message de confirmation ou redirigez l'utilisateur vers une autre page
            $this->addFlash('success', 'Le sport a été créé avec succès.');

            return $this->redirectToRoute('home'); // Remplacez 'home' par le nom de votre route
        }

        return $this->render('sport/create_sport.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/sports", name="sport_list")
     */
    public function listSports(): Response
    {
        $sports = $this->getDoctrine()->getRepository(Sport::class)->findAll();

        return $this->render('sport/list_sports.html.twig', [
            'sports' => $sports,
        ]);
    }
}
