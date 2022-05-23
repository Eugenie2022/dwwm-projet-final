<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function header(ManagerRegistry $doctrine): Response
    {
        return $this->render('default/_header.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }

    public function footer(ManagerRegistry $doctrine): Response
    {
        return $this->render('default/_footer.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
