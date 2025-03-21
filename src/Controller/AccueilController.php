<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $offres = $entityManager->getRepository(Offre::class)->findBy([], ['date_creation' => 'DESC'], 4);
        $entreprises = $entityManager->getRepository(Entreprise::class)->plusdoffres();
        
        return $this->render('accueil.html.twig', [
            'offres' => $offres,
            'entreprises' => $entreprises
        ]);
    }

}
