<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SportRepository;
use App\Repository\PratiqueRepository;
use App\Form\RecherchePartenaireType;

class RecherchePartenaireController extends AbstractController
{
    /**
     * @Route("/recherchep", name="recherche_partenaire")
     */
    public function index(Request $request, SportRepository $sportRepo, PratiqueRepository $pratiqueRepo): Response
    {
        $recherchePartenaireForm = $this->createForm(RecherchePartenaireType::class);
        $recherchePartenaireForm->handleRequest($request);

        $resultats = [];

        if ($recherchePartenaireForm->isSubmitted() && $recherchePartenaireForm->isValid()) {
            // Récupérer les données du formulaire
            $data = $recherchePartenaireForm->getData();
            $sport = $data['sport'];
            $niveau = $data['niveau'];
            $departement = $data['departement'];

            // Utiliser le repository pour rechercher les partenaires correspondants
            $resultats = $pratiqueRepo->findByCriteria($sport, $niveau, $departement);
        }

        return $this->render('recherche_partenaire/recherche_partenaire.html.twig', [
            'recherche_partenaire_form' => $recherchePartenaireForm->createView(),
            'resultats' => $resultats,
        ]);
    }
}
