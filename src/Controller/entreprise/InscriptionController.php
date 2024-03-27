<?php

namespace App\Controller\entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/entreprise-candidat', name: 'entreprise-candidat')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/inscription.html.twig', parameters: [

        ]);
    }
}
