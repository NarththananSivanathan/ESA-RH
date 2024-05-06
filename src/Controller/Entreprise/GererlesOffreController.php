<?php

namespace App\Controller\Entreprise;

use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GererlesOffreController extends AbstractController
{
    #[Route('/entreprise/afficher-les-offres', name: 'afficher-les-offres')]
    public function afficherLesOffres(Request $request, OffreRepository $offreRepository): Response
    {
        $offres = $offreRepository->findBy(
            [
                'idEntreprise' => $this->getUser()->getEntreprise()
            ]
        );
        $entreprise = $this->getUser()->getEntreprise();

        return $this->render(view: 'entreprise/gererlesOffre.html.twig', parameters: [
            'offres' => $offres,
            'entreprise' => $entreprise,
        ]);
    }

}

