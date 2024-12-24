<?php
// src/Controller/SearchController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\PratiqueType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request): Response
    {
        $form = $this->createForm(PratiqueType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement du formulaire et recherche des utilisateurs
            $data = $form->getData();

            $users = $this->getDoctrine()->getRepository(User::class)
                ->findBySearchCriteria($data['sport'], $data['niveau'], $data['user.Departement']);

            return $this->render('search/results.html.twig', ['users' => $users]);
        }

        return $this->render('search/recherche.html.twig', ['form' => $form->createView()]);
    }
}
