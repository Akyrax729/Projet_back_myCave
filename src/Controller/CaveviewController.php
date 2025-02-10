<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CaveviewController extends AbstractController{
    #[Route('/cave/{id}', name: 'app_caveview')]
    public function index(): Response
    {
        return $this->render('caveview/caveview.html.twig', [
            
        ]);
    }
}
