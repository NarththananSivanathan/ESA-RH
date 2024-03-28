<?php

namespace App\Controller\entreprise;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreeOffreController extends AbstractController
{
    #[Route('/cree-offre', name: 'cree-offre')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/creeOffre.html.twig', parameters: [

        ]);
    }
}
