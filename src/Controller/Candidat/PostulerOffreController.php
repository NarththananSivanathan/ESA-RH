<?php

namespace App\Controller\Candidat;


use App\Entity\Offre;
use App\Entity\Candidature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/postule/{idOffre}' , name: 'app_postuler_')]
class PostulerOffreController extends AbstractController
{
    #[Route('/', name: 'offre')]
    public function candidater(int $idOffre, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CANDIDAT');

        $offreRepository = $entityManager->getRepository(Offre::class);
        $offre = $offreRepository->find($idOffre);
        
        // Vérifiez si l'offre existe
        if (!$offre) {
            throw $this->createNotFoundException('L\'offre n\'existe pas');
        }

        return $this->render('candidat/postulerOffre.html.twig', [
            'offre' => $offre,
        ]);
    }

    #[Route('/candidater', name: 'candidater')]
    public function postuler( Request $request, int $idOffre, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CANDIDAT');

        $offreRepository = $entityManager->getRepository(Offre::class);
        $offre = $offreRepository->find($idOffre);
        
        // Récupérez l'utilisateur connecté
        $candidat = $this->getUser();
        
        // Créez une nouvelle candidature avec le statut "En attente"
        $candidature = new Candidature();
        $candidature->setStatutCandidature('En attente');
        $candidature->setIdOffre($offre);
        $candidature->setIdCandidat($candidat);
        $message = $request->request->get('message');
        $candidature->setMessage($message);
        
        
        $entityManager->persist($candidature);
        $entityManager->flush();

        $candidatureEnvoyee = false;
        if($candidature->getId()){
            $candidatureEnvoyee = true;
        }

        if ($candidatureEnvoyee) {
            $this->addFlash('success', 'Candidature envoyée avec succès.');
            return $this->redirectToRoute('offres_details' , ['id' => $idOffre]);
        } else {
            $this->addFlash('error', 'Un problème s\'est produit lors de l\'envoi de la candidature.');
            return $this->redirectToRoute('app_postuler_offre', ['idOffre' => $idOffre]);
        }
        
    }


}

