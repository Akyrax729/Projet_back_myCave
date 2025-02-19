<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Repository\WineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CaveviewController extends AbstractController{
    #[Route('/cave/{id}', name: 'app_caveview')]
    public function index(Cave $cave, WineRepository $wineRepository): Response
    {
        $wines =$wineRepository->findBy(['cave' => $cave]);

        return $this->render('caveview/caveview.html.twig', [
            'cave'=>$cave,
            'wines'=>$wines,
        ]);
    }
}
