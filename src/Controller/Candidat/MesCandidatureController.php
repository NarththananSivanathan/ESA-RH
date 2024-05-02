<?php

namespace App\Controller\Candidat;

use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesCandidatureController extends AbstractController
{

    #[Route('/candidatures', name: 'app_candidatures')]
    public function index(): Response
    {
        $candidat = $this->getUser();

        if (!$candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        if ($candidat instanceof Candidat) {
            $candidatures = $candidat->getCandidatures();
        }

        $candidatures = $candidatures->toArray();
        usort($candidatures, function ($a, $b) {
            return $b->getDateCandidature() <=> $a->getDateCandidature();
        });

        $nombreCandidatures = count($candidatures);

        return $this->render('candidat\mesCandidatures.html.twig', [
            'candidatures' => $candidatures,
            'nombreCandidatures' => $nombreCandidatures,
        ]);
    }
}
