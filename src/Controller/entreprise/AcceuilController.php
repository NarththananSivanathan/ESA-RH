<?php

namespace App\Controller\entreprise;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{

    #[Route('/acceuil-entreprise', name: 'acceuil-entreprise')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/acceuil.html.twig', parameters: []);
    }
}
