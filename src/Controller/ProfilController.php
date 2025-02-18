<?php

namespace App\Controller;

use App\Repository\CaveRepository;
use App\Repository\WineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(WineRepository $wineRepo, CaveRepository $caveRepository): Response
    {
        
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $cave = $caveRepository->findOneBy(['user' => $user]);
        $wines = $wineRepo->findBy(['cave' => $cave]);

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'wines' => $wines,
            'cave' => $cave,
        ]);
    }
}

