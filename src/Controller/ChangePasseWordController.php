<?php

namespace App\Controller;

use App\Entity\Recruteur;
use App\Form\CandidatType;
use App\Form\PassewordType;
use App\Form\RecruteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasseWordController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/changer-mdp', name: 'changer-mdp')]

        public function index(): Response
        {
            $form = $this->createForm(PassewordType::class);
        return $this->render('ChangerMotDePasse.html.twig', [
            'form' => $form
        ]);



    }

}
