<?php

namespace App\Controller\candidat;

use App\Entity\Home;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription-candidat', name: 'inscription-candidat')]
    public function index(): Response
    {
        return $this->render(view: 'candidat/inscription.html.twig', parameters: [

        ]);
    }
}
