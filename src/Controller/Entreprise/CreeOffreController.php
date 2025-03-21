<?php

namespace App\Controller\Entreprise;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
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
            'form' => $form,
        ]);
    }

    #[Route('entreprise/modifier-offre/{id}', name: 'modifier-offre')]
    public function modifierOffre (Request $request, EntityManagerInterface $em, OffreRepository $offreRepository ): Response
    {
        $offre = $offreRepository->findOneBy(
            [
                'idEntreprise' => $this->getUser()->getEntreprise(),
                'id' => $request->get('id')
            ]
        );

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
                    'Votre offre a bien été bien modifiée.'
                );

            }
        }
        return $this->render(view: 'entreprise/modifierUneOffre.html.twig', parameters: [
            'form' => $form,
        ]);
    }

    #[Route('entreprise/supprimer-offre/{id}', name: 'supprimer-offre')]
    public function supprimierOffre (Request $request, EntityManagerInterface $em, OffreRepository $offreRepository ): Response
    {
        $offre = $offreRepository->findOneBy(
            [
                'idEntreprise' => $this->getUser()->getEntreprise(),
                'id' => $request->get('id')
            ]
        );
        $em->remove($offre);
        $em->flush();

        $this->addFlash(
            'notice',
            'Votre offre a bien été bien supprimée.'
        );

        return $this->redirectToRoute('afficher-les-offres');
    }
}
