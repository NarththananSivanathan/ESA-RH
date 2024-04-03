<?php

namespace App\Controller\candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class DetailOffreController extends AbstractController
{

    #[Route('/detailO', name: 'app_detail0ffre')] 
    public function index(): Response
    {
        return $this->render('candidat\detailOffre.html.twig', [
            
        ]);
    }
}
