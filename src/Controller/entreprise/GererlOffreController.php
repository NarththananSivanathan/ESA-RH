<?php

namespace App\Controller\entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GererlOffreController extends AbstractController
{
    #[Route('/gererloffre', name: 'gererloffre')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/gererlOffre.html.twig', parameters: [

        ]);
    }
}