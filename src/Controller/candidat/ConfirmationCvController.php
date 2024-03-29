<?php

namespace App\Controller\candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class ConfirmationCvController extends AbstractController
{
    #[Route('/confirmation', name: 'app_confirmation')]
    public function index(): Response
    {
        return $this->render('candidat\confirmationCv.html.twig', [
            
        ]);
    }
}