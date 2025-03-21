<?php

namespace App\Controller\Candidat;


use App\Entity\Offre;
use App\Service\CvManager;
use App\Entity\Candidature;
use App\Service\CandidatVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/postule/{idOffre}' , name: 'app_postuler_')]
class PostulerOffreController extends AbstractController
{
    private $cvManager;

    public function __construct(CvManager $cvManager)
    {
        $this->cvManager = $cvManager;
    }
    
    #[Route('/', name: 'offre')]
    public function candidater(int $idOffre, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CANDIDAT');

        $offreRepository = $entityManager->getRepository(Offre::class);
        $offre = $offreRepository->find($idOffre);

        $candidature = $entityManager->getRepository(Candidature::class)->findOneBy([
            'idOffre' => $offre->getId(),
            'idCandidat' => $this->getUser()->getId(),
        ]);

        $dejaPostule = $candidature !== null;

        return $this->render('candidat/postulerOffre.html.twig', [
            'offre' => $offre,
            'dejaPostule' => $dejaPostule
        ]);
    }

    #[Route('/candidater', name: 'candidater')]
    public function postuler( Request $request, int $idOffre, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CANDIDAT');

        $offreRepository = $entityManager->getRepository(Offre::class);
        $offre = $offreRepository->find($idOffre);

        $candidat = $this->getUser();

        $choixCv = $request->request->get('cv_choice');
        $choixLm = $request->request->get('lm_choice');
        $message = $request->request->get('message');
        $lmFileName = null;

        if ($choixCv === 'cv_exist') {
            $cvFileName = $candidat->getCv();
            $this->cvManager->copyCvToCandidaturesDirectory($cvFileName);
        } elseif ($choixCv === 'new_cv') {
            $cvFile = $request->files->get('cv');
            if ($cvFile) {
                $cvFileName = $this->cvManager->moveUploadedFile($cvFile, $this->getParameter('candidature_cv'));
            }
        }
        if ($choixLm === 'lm_exist') {
            $lmFileName = $candidat->getLettreDeMotivation();
            $this->cvManager->copyLmToCandidaturesDirectory($lmFileName);
        } elseif ($choixLm === 'new_lm') {
            $lmFile = $request->files->get('lm');
            if ($lmFile) {
                $lmFileName = $this->cvManager->moveUploadedFile($lmFile, $this->getParameter('candidature_lm'));
            }
        }

            $candidature = new Candidature();
            $candidature->setStatutCandidature('En attente');
            $candidature->setIdOffre($offre);
            $candidature->setIdCandidat($candidat);
            $candidature->setMessage($message);
            $candidature->setCv($cvFileName);
            $candidature->setLettreDeMotivation($lmFileName);
            $candidature->setCv($cvFileName);

            $entityManager->persist($candidature);
            $entityManager->flush();

            $candidatureEnvoyee = false;
            if($candidature->getId()){
                $candidatureEnvoyee = true;
            }

            if ($candidatureEnvoyee) {
                $this->addFlash('success', 'Candidature envoyée avec succès.');
                return $this->redirectToRoute('offres_details', ['id' => $idOffre]);
            } else {
                $this->addFlash('error', 'Un problème s\'est produit lors de l\'envoi de la candidature.');
                return $this->redirectToRoute('app_postuler_offre', ['idOffre' => $idOffre]);
            }      
            
    }

    

    


}

