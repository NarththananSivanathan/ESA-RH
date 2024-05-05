<?php

namespace App\Controller\Candidat;

use App\Entity\Offre;
use App\Entity\Candidature;
use App\Repository\OffreRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/offres', name: 'offres_')]
class RechercheOffreController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(OffreRepository $offresRepository): Response
    {
        $offres = $offresRepository->findBy([], ['date_creation' => 'DESC']);
        
        return $this->render('candidat\rechercheOffre.html.twig', [
            'offres' => $offres
        ]);
    }

    #[Route('/filtres', name: 'recherche')]
    public function filtre(Request $request, OffreRepository $offresRepository): Response
    {
        $keyword = $request->query->get('keyword');
        $contractType = $request->query->get('typeContrat');

        $offres = $offresRepository->filterByCriteria($keyword, $contractType);

        return $this->render('candidat/rechercheOffre.html.twig', [
            'offres' => $offres
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function details(int $id, OffreRepository $offresRepository, EntityManagerInterface $entityManager): Response
    {
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        // Vérifier si l'offre existe
        if (!$offre) {
            throw $this->createNotFoundException('Offre non trouvée');
        }

        $candidature = $entityManager->getRepository(Candidature::class)->findOneBy([
            'idOffre' => $offre->getId(),
            'idCandidat' => $this->getUser()->getId(),
        ]);

        $dejaPostule = $candidature !== null;
        
        return $this->render('candidat/detailOffre.html.twig', [
            'offre' => $offre,
            'dejaPostule' => $dejaPostule
        ]);
    }
}
