<?php

namespace App\Controller\candidat;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AcceuilController extends AbstractController
{
    #[Route('/acceuil-candidat', name: 'acceuilCandidat')]
    public function index(): Response
    {
        return $this->render('candidat/acceuil.html.twig', [
            
        ]);
    }
}
