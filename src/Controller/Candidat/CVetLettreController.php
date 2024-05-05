<?php

namespace App\Controller\Candidat;

use App\Service\CandidatVerifier;
use App\Service\CvManager;
use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CVetLettreController extends AbstractController
{
    private $cvManager;
    private $candidatVerifier;

    public function __construct(CvManager $cvManager , CandidatVerifier $candidatVerifier)
    {
        $this->cvManager = $cvManager;
        $this->candidatVerifier = $candidatVerifier;
    }

    #[Route('/cv', name: 'app_cv')]
    public function index(): Response
    {
        $candidat = $this->getUser();
        $this->candidatVerifier->estCandidat($candidat);

        return $this->render('candidat\CVetLettre.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/cv/modifier', name: 'modifier_cv')]
    public function modifierCV(Request $request , EntityManagerInterface $entityManager): Response
    {
        // Vérifier si le candidat est connecté
        $candidat = $this->getUser();
        $this->candidatVerifier->estCandidat($candidat);

        $cvFile = $request->files->get('cv');
        if ($candidat->getCv()) {
            // Supprimer le fichier du CV précédent
            $cvPath = $this->getParameter('candidat_cv') . '/' . $candidat->getCv();
            if (file_exists($cvPath)) {
                unlink($cvPath);
            }
        }
        $cvFileName = $this->cvManager->moveUploadedFile($cvFile, $this->getParameter('candidat_cv'));
        $candidat->setCv($cvFileName);

        $entityManager->persist($candidat);
        $entityManager->flush();

        return $this->redirectToRoute('app_cv');
    }

    #[Route('/lettre_motivation/modifier', name: 'modifier_lettre_motivation')]
    public function modifierLettreMotivation(Request $request , EntityManagerInterface $entityManager): Response
    {
        // Vérifier si le candidat est connecté
        $candidat = $this->getUser();
        $this->candidatVerifier->estCandidat($candidat);

        $lmFile = $request->files->get('lettre_motivation');

        if ($candidat->getLettreDeMotivation()) {
            $lmPath = $this->getParameter('candidat_lm') . '/' . $candidat->getLettreDeMotivation();
            if (file_exists($lmPath)) {
                unlink($lmPath);
            }
        }
        $lmFileName = $this->cvManager->moveUploadedFile($lmFile, $this->getParameter('candidat_lm'));
        $candidat->setLettreDeMotivation($lmFileName);

        $entityManager->persist($candidat);
        $entityManager->flush();

        return $this->redirectToRoute('app_cv');
    }

    
}
