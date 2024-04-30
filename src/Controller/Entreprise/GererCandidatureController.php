<?php

namespace App\Controller\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GererCandidatureController extends AbstractController
{
    #[Route('/gerercandidature', name: 'gerercandidature')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/gererunecandidature.html.twig', parameters: [

        ]);
    }
}
