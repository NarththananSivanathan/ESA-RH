<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/lesentreprises', name: 'lesentreprises')]
    public function index(): Response
    {
        return $this->render(view: 'touteslesentreprises.html.twig', parameters: [

        ]);
    }
}