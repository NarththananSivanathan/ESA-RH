<?php

namespace App\Controller\Candidat;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AccueilController extends AbstractController
{
    #[Route('/candidat/accueil', name: 'accueil_candidat')]
    public function index(): Response
    {
        return $this->render('candidat/accueil.html.twig', [

        ]);
    }
}
