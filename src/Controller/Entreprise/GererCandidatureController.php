<?php

namespace App\Controller\Entreprise;
use App\Entity\Candidature;
use App\Repository\CandidatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GererCandidatureController extends AbstractController
{
    #[Route('/entreprise/gerer-une-candidature/{id}', name: 'gerer-une-candidature')]
    public function gererCandidature(Request $request, CandidatureRepository $candidatureRepository, AuthenticationUtils $authenticationUtils): Response
    {
        $cadidature = $candidatureRepository->find($request->get('id'));
        if ($cadidature === null) {
            return $this->redirectToRoute('afficher-les-offres');
        }
        $entreprise = $this->getUser()->getEntreprise();
        dump($cadidature);

        return $this->render(view: 'entreprise/gererunecandidature.html.twig', parameters: [
            'candidature' => $cadidature,
            'entreprise' => $entreprise,
        ]);
    }

    #[Route('/entreprise/accepter/{id}', name: 'accepter-une-candidature')]
    public function accepterCandidature(Request $request, CandidatureRepository $candidatureRepository, EntityManagerInterface $em): Response
    {
        $candidature = $candidatureRepository->find($request->get('id'));
        if ($candidature === null) {
            return $this->redirectToRoute('afficher-les-offres');
        }
        $candidature->setStatutCandidature(Candidature::STATUT_ACCEPTED);
        $em->flush();
        return $this->redirectToRoute('gerer_une_offre', ['id' => $candidature->getIdOffre()->getId()]);
    }

    #[Route('/entreprise/refuser/{id}', name: 'refuser-une-candidature')]
    public function refuserCandidature(Request $request, CandidatureRepository $candidatureRepository, EntityManagerInterface $em): Response
    {
        $candidature = $candidatureRepository->find($request->get('id'));
        if ($candidature === null) {
            return $this->redirectToRoute('afficher-les-offres');
        }
        $candidature->setStatutCandidature(Candidature::STATUT_REFUSED);
        $em->flush();
        return $this->redirectToRoute('gerer_une_offre', ['id' => $candidature->getIdOffre()->getId()]);
    }
}
