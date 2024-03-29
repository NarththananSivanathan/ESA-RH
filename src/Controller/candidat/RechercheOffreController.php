<?php

namespace App\Controller\candidat;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RechercheOffreController extends AbstractController
{

    #[Route('/recherche', name: 'app_recherche')]
    public function index(): Response
    {
        return $this->render('candidat\rechercheOffre.html.twig', [
            
        ]);
    }
    
}
