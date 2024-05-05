<?php
namespace App\Service;

use App\Entity\Candidat;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatVerifier extends AbstractController
{
    public function estCandidat(UserInterface $user)
    {
        if (!$user || !$user instanceof Candidat) {
            throw $this->createAccessDeniedException('Vous devez être connecté en tant que candidat pour accéder à cette page.');
        }
    }
}