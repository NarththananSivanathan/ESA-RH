<?php

namespace App\Controller\Candidat;

use App\Entity\Offre;
use App\Repository\OffreRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/offres', name: 'offres_')]
class RechercheOffreController extends AbstractController
{

    /* #[Route('/recherche', name: 'app_recherche')]
    public function index(): Response
    {
        return $this->render('candidat\rechercheOffre.html.twig', [

        ]);
    } */
    
        #[Route('/', name: 'index')]
        public function index(OffreRepository $offresRepository, EntrepriseRepository $entrepriseRepository): Response
        {
            $offres = $offresRepository->findBy([], ['date_creation' => 'DESC']);
            // Tableau pour stocker les informations sur les entreprises pour chaque offre
            $offresAvecEntreprise = [];
            // Associer chaque offre à son entreprise respective
            foreach ($offres as $offre) {
                $entreprise = $entrepriseRepository->find($offre->getIdEntreprise());
                $offresAvecEntreprise[] = [
                    'offre' => $offre,
                    'entreprise' => $entreprise
                ];
            }
            // Passer les données à la vue Twig
            return $this->render('candidat\rechercheOffre.html.twig', [
                'offresAvecEntreprise' => $offresAvecEntreprise
            ]);
        }

        #[Route('/{id}', name: 'details')]
        public function details(int $id, OffreRepository $offresRepository, EntrepriseRepository $entrepriseRepository): Response
        {
            // Récupérer l'offre à partir du slug
            $offre = $offresRepository->findOneBy(['id' => $id]);
            // Vérifier si l'offre existe
            if (!$offre) {
                throw $this->createNotFoundException('Offre non trouvée');
            }
            // Récupérer l'entreprise associée à l'offre
            $entreprise = $entrepriseRepository->find($offre->getIdEntreprise());
            // Afficher les détails de l'offre dans la vue Twig
            return $this->render('candidat/detailOffre.html.twig', [
                'offre' => $offre,
                'entreprise' => $entreprise
            ]);
        }
    

}
