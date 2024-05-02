<?php

namespace App\Controller\Entreprise;

use App\Entity\Offre;
use App\Form\OffreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CreeOffreController extends AbstractController
{
    #[Route('entreprise/cree-offre', name: 'cree-offre')]
    public function creationOffre (Request $request, EntityManagerInterface $em, AuthenticationUtils $authenticationUtils): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);

        if ($request->isMethod('POST')) {
            $allValues = $request->request->all();
            $form->submit($allValues[$form->getName()]);

            if ($form->isSubmitted() && $form->isValid()) {

                /** @var Offre $offre */

                $offre = $form->getData();

                $offre->setDateCreation(new \DateTimeImmutable());
                $offre->setIdEntreprise($this->getUser()->getEntreprise());

                $em->persist($offre);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Votre offre a bien été créée.'
                );

                return $this->redirectToRoute('accueil_entreprise');
            }
        }
        return $this->render(view: 'entreprise/creeOffre.html.twig', parameters: [
            'form' => $form
        ]);
    }
}
