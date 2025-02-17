<?php

namespace App\Controller;

use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CaveController extends AbstractController{
    #[Route('/cave', name: 'app_cave')]
    public function index(CaveRepository $caveRepository): Response
    {
        $caves = $caveRepository->findAll();
        $user = $caveRepository->findBy(['user' => $this->getUser()]);

        return $this->render('cave/cave.html.twig', [
            'caves' => $caves,
            'user' => $user
        ]);
    }
}
