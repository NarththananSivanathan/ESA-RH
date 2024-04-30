<?php

namespace App\Controller\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GererlesOffreController extends AbstractController
{
    #[Route('/gererlesoffres', name: 'gererlesoffres')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/gererlesOffre.html.twig', parameters: [

        ]);
    }
}
