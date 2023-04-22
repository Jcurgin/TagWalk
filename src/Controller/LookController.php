<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LookController extends AbstractController
{
    #[Route('/look', name: 'app_look')]
    public function index(): Response
    {
        return $this->render('look/index.html.twig', [
            'controller_name' => 'LookController',
        ]);
    }

    #[Route('/look/edit', name: 'app_look_edit')]
    public function edit(): Response
    {

        $this->denyAccessUnlessGranted('EDIT_LOOK_CONTROLLER');

        return $this->render('look/edit.html.twig', [
            'controller_name' => 'LookController',
        ]);
    }
}
