<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pratique;
use App\Entity\Sport;
use App\Form\PratiqueType;

class PratiqueController extends AbstractController
{
    /**
     * @Route("/add-practice", name="add_practice")
     */
    public function addPractice(Request $request, EntityManagerInterface $entityManager)
    {
        $pratique = new Pratique();
        $form = $this->createForm(PratiqueType::class, $pratique);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSportName = $form->get('new_sport')->getData();
            if ($newSportName) {
                $sport = new Sport();
                $sport->setNomSport($newSportName); // Make sure the property is 'design' in your Sport entity
                // Make sure the property is 'design' in your Sport entity
                // Make sure the property is 'design' in your Sport entity
                $sport->setImage('fff');
                $entityManager->persist($sport);
                $entityManager->flush();

                $pratique->setSport($sport);
            }

            $user = $this->getUser();
            $pratique->setUser($user); // This should link the Pratique to the logged-in user

            $entityManager->persist($pratique);
            $entityManager->flush();

            $this->addFlash('success', 'Votre pratique sportive a été ajoutée avec succès!');
            return $this->redirectToRoute('home');
        }

        return $this->render('pratique/ajouterpratique.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
