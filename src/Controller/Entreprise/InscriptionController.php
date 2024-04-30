<?php

namespace App\Controller\Entreprise;
use App\Entity\Recruteur;
use App\Form\RecruteurType;
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

    #[Route('/inscription-entreprise', name: 'inscription-entreprise')]
    public function inscription(Request $request, EntityManagerInterface $em): Response
    {
        $recurteur = new Recruteur();
        $form = $this->createForm(RecruteurType::class,$recurteur);

        if ($request->isMethod('POST')) {
            $allValues = $request->request->all();
            $form->submit($allValues[$form->getName()]);

            if ($form->isSubmitted() && $form->isValid()) {

            /** @var Recruteur $recurteur */

                $recurteur = $form->getData();

                $hashedPassword = $this->passwordHasher->hashPassword(
                    $recurteur,
                    $recurteur->getPassword()
                );
                $recurteur->setPassword($hashedPassword);

                $recurteur->setDateInscription(new \DateTimeImmutable());

                $recurteur->setRoles(['ROLE_RECRUTEUR']);

                $recurteur->getEntreprise()->setIsValid(false);

                $em->persist($recurteur);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Vous êtes bien inscrit, veuillez vous connecter pour accéder à votre espace.'
                );

                return $this->redirectToRoute('connexion');
            }
        }

        return $this->render(view: 'entreprise/inscription.html.twig', parameters: [
            'form' => $form
        ]);
    }
}
