<?php

namespace App\Controller\Candidat;

use App\Entity\Adresse;
use App\Entity\Candidat;
use App\Form\CandidatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/inscription-candidat', name: 'inscription-candidat')]
    public function inscription(Request $request, EntityManagerInterface $em): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class,$candidat);

        if ($request->isMethod('POST')) {
            $allValues = $request->request->all();
            $form->submit($allValues[$form->getName()]);

            if ($form->isSubmitted() && $form->isValid()) {

            /** @var Candidat $candidat */

                $candidat = $form->getData();

                $hashedPassword = $this->passwordHasher->hashPassword(
                    $candidat,
                    $candidat->getPassword()
                );
                $candidat->setPassword($hashedPassword);

                $candidat->setDateInscription(new \DateTimeImmutable());

                $candidat->setRoles(['ROLE_CANDIDAT']);

                $em->persist($candidat);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Vous êtes bien inscrit, veuillez vous connecter pour accéder à votre espace.'
                );

                return $this->redirectToRoute('connexion');
            }
        }

        return $this->render(view: 'candidat/inscription.html.twig', parameters: [
            'form' => $form
        ]);
    }
}
