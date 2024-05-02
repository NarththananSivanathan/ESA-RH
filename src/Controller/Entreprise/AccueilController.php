<?php

namespace App\Controller\Entreprise;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccueilController extends AbstractController
{

    #[Route('/entreprise/accueil', name: 'accueil_entreprise')]
    public function accueil(AuthenticationUtils $authenticationUtils): Response
    {

        $recruteur = $this->getUser();
        $entreprise = $this->getUser()->getEntreprise();
        $adresse = $this->getUser()->getAdresse();
        $lastOffre = $this->getUser()->getEntreprise()->getOffres()->last();

        $countOffre = $this->getUser()->getEntreprise()->getOffres()->count();
        return $this->render(view: 'entreprise/accueil.html.twig', parameters: [
            'recruteur' => $recruteur,
            'entreprise' => $entreprise,
            'adresse' => $adresse,
            'lastOffre' => $lastOffre,
            'countOffre' => $countOffre
        ]);
    }

}
