<?php

namespace App\Controller\entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContacterCandidatController extends AbstractController
{
    #[Route('/contactercandidat', name: 'contactercandidat')]
    public function index(): Response
    {
        return $this->render(view: 'entreprise/contactercandidat.html.twig', parameters: [

        ]);
    }
}