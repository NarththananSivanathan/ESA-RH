<?php

namespace App\Controller\candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class DetailCandidatureController extends AbstractController
{

    #[Route('/detailC', name: 'app_detailCandidature')] 
    public function index(): Response
    {
        return $this->render('candidat\detailCandidature.html.twig', [
            
        ]);
    }
}
