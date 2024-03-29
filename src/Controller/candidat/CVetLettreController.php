<?php

namespace App\Controller\candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class CVetLettreController extends AbstractController
{

    #[Route('/cv', name: 'app_cv')]
    public function index(): Response
    {
        return $this->render('candidat\CVetLettre.html.twig', [
            
        ]);
    }
}
