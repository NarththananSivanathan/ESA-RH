<?php

namespace App\Service;
use App\Entity\Utilisateur;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CvManager extends AbstractController
{
    public function moveUploadedFile( $file , $directory)
    {
        $candidat = $this->getUser();
        $fileName = str_replace(' ', '_', $candidat->getNom().$candidat->getPrenom()) . '_' . uniqid() . '.' . $file->guessExtension();
        // Déplacer le fichier vers le répertoire de stockage
        $file->move(
            $directory,
            $fileName
        );

        return $fileName;
    }

    public function copyCvToCandidaturesDirectory($cvFileName)
    {
        $cvPath = $this->getParameter('candidat_cv') . '/' . $cvFileName;
        $candidatureCvPath = $this->getParameter('candidature_cv') . '/' . $cvFileName;
        $filesystem = new Filesystem();
        try {
            $filesystem->copy($cvPath, $candidatureCvPath);
        } catch (IOExceptionInterface $exception) {
            throw new \Exception("Une erreur s'est produite lors de la copie du CV vers le dossier des candidatures.");
        }
    }

    public function copyLmToCandidaturesDirectory($lmFileName)
    {
        $cvPath = $this->getParameter('candidat_lm') . '/' . $lmFileName;
        $candidatureCvPath = $this->getParameter('candidature_lm') . '/' . $lmFileName;
        $filesystem = new Filesystem();
        try {
            $filesystem->copy($cvPath, $candidatureCvPath);
        } catch (IOExceptionInterface $exception) {
            throw new \Exception("Une erreur s'est produite lors de la copie de la lettre vers le dossier des candidatures.");
        }
    }
}
