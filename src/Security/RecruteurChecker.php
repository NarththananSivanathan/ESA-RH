<?php
namespace App\Security;

use App\Entity\Recruteur as recruteur;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RecruteurChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof recruteur) {
            return;
        }

        if ($user->getEntreprise()->isIsValid() === false) {
            // the message passed to this exception is meant to be displayed to the user
            throw new CustomUserMessageAccountStatusException('Votre compte entreprise n\'est pas encore validé. Veuillez attendre la validation de votre compte par un administrateur.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {

    }
}
