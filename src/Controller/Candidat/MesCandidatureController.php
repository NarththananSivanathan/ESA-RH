<?php

namespace App\Controller\Candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CandidatureRepository;

class MesCandidatureController extends AbstractController
{

    #[Route('/candidatures', name: 'app_candidatures')]
    public function index(): Response
    {
        return $this->render('candidat\mesCandidatures.html.twig', [

        ]);
    }




    // public function accueil(CandidatureRepository $candidatureRepository): Response
    // {
    //     // Récupérez le nombre de candidatures depuis votre base de données
    //     $nombreCandidatures = $candidatureRepository->count([]);

    //     return $this->render('candidat/accueil.html.twig', [
    //         'nombreCandidatures' => $nombreCandidatures,
    //     ]);
    // }


}

