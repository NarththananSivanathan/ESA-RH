<?php

namespace App\Controller\Candidat;

use App\Entity\Candidat;
use App\Entity\Candidature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailCandidatureController extends AbstractController
{

    #[Route('/candidatures/{id}', name: 'candidature_details')]
    public function index(int $id , EntityManagerInterface $entityManager ): Response
    {
        $candidature = $entityManager->getRepository(Candidature::class)->find($id);
        
        return $this->render('candidat\detailCandidature.html.twig', [
            'candidature' => $candidature,
        ]);
    }
}
