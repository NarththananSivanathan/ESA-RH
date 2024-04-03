<?php

namespace App\Controller\candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostulerOffreController extends AbstractController
{
    #[Route('/postule', name: 'app_postuler_offre')]
    public function index(): Response
    {
        return $this->render('candidat\postulerOffre.html.twig', [
            
        ]);
    }
}
