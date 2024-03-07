<?php

namespace App\Controller;

use App\Entity\Home;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'hello')]
    public function index(): Response
    {
        return $this->render(view: 'hello.html.twig', parameters: [

        ]);
    }
}
