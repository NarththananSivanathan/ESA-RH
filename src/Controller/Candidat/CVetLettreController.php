<?php

namespace App\Controller\Candidat;


use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CVetLettreController extends AbstractController
{

    #[Route('/cv', name: 'app_cv')]
    public function index(): Response
    {
        $candidat = $this->getUser();
        if (!$candidat || !$candidat instanceof Candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté en tant que candidat pour accéder à cette page.');
        }

        return $this->render('candidat\CVetLettre.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/cv/modifier', name: 'modifier_cv')]
    public function modifierCV(Request $request , EntityManagerInterface $entityManager): Response
    {
        // Vérifier si le candidat est connecté
        $candidat = $this->getUser();
        if (!$candidat || !$candidat instanceof Candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté en tant que candidat pour accéder à cette page.');
        }

        // Récupérer le fichier CV téléchargé
        $cvFile = $request->files->get('cv');

        if ($candidat->getCv()) {
            // Supprimer le fichier du CV précédent
            $cvPath = $this->getParameter('candidat_cv') . '/' . $candidat->getCv();
            if (file_exists($cvPath)) {
                unlink($cvPath);
            }
        }

        // Déplacer le fichier vers le répertoire de stockage
        $cvFileName = $this->moveUploadedFile($cvFile , $this->getParameter('candidat_cv'));

        // Enregistrer le nom du fichier dans l'entité Candidat
        $candidat->setCv($cvFileName);

        // Enregistrer les modifications dans la base de données
        $entityManager->persist($candidat);
        $entityManager->flush();

        // Rediriger l'utilisateur vers une page de confirmation ou une autre page
        return $this->redirectToRoute('app_cv');
    }

    #[Route('/lettre_motivation/modifier', name: 'modifier_lettre_motivation')]
    public function modifierLettreMotivation(Request $request , EntityManagerInterface $entityManager): Response
    {
        // Vérifier si le candidat est connecté
        $candidat = $this->getUser();
        if (!$candidat || !$candidat instanceof Candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté en tant que candidat pour accéder à cette page.');
        }

        // Récupérer le fichier Lettre de Motivation téléchargé
        $lmFile = $request->files->get('lettre_motivation');

        if ($candidat->getLettreDeMotivation()) {
            // Supprimer le fichier du CV précédent
            $lmPath = $this->getParameter('candidat_lm') . '/' . $candidat->getLettreDeMotivation();
            if (file_exists($lmPath)) {
                unlink($lmPath);
            }
        }

        // Déplacer le fichier vers le répertoire de stockage
        $lmFileName = $this->moveUploadedFile($lmFile , $this->getParameter('candidat_lm'));

        // Enregistrer le nom du fichier dans l'entité Candidat
        $candidat->setLettreDeMotivation($lmFileName);

        // Enregistrer les modifications dans la base de données
        $entityManager->persist($candidat);
        $entityManager->flush();

        // Rediriger l'utilisateur vers une page de confirmation ou une autre page
        return $this->redirectToRoute('app_cv');
    }

    private function moveUploadedFile($file, $directory)
    {
        // Générer un nom de fichier unique
        //$fileName = uniqid() . '.' . $file->guessExtension();

        $candidat = $this->getUser();

        if (!$candidat || !$candidat instanceof Candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté en tant que candidat pour accéder à cette page.');
        }

        $fileName = str_replace(' ', '_', $candidat->getNom()) . '_' . uniqid() . '.' . $file->guessExtension();

        // Déplacer le fichier vers le répertoire de stockage
        $file->move(
            $directory,
            $fileName
        );

        return $fileName;
    }
}
