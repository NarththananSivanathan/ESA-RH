<?php

namespace App\Controller\Entreprise;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{

    #[Route('/entreprise/accueil', name: 'accueil_entreprise')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/accueil.html.twig', parameters: [

        ]);
    }

}
