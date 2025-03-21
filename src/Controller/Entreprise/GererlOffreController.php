<?php

namespace App\Controller\Entreprise;
use App\Entity\Offre;
use App\Repository\CandidatureRepository;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GererlOffreController extends AbstractController
{
    #[Route('/entreprise/gererloffre/{id}', name: 'gerer_une_offre')]
    public function gererUneOffre(Request $request, OffreRepository $offreRepository): Response
    {
        $offre = $offreRepository->findOneBy(
            [
                'idEntreprise' => $this->getUser()->getEntreprise(),
                'id' => $request->get('id')
            ]
        );
        if ($offre === null) {
            return $this->redirectToRoute('afficher-les-offres');
        }
        dump($offre);





        $entreprise = $this->getUser()->getEntreprise();

        return $this->render(view: 'entreprise/gererlOffre.html.twig', parameters: [
            'offre' => $offre,
            'entreprise' => $entreprise,
        ]);
    }

}
