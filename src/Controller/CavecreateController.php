<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Form\CavecreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CavecreateController extends AbstractController{
    #[Route('/cavecreate', name: 'app_cavecreate')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $cave = new Cave();

        $form = $this->createForm(CavecreateType::class, $cave);

        $form->handleRequest($request);

        $get = $this->getUser();

        if($form->isSubmitted() && $form->isValid())
        {

            $cave->setUser($get);

            $entityManager->persist($cave);

            $entityManager->flush();

            $this->addFlash('success', 'Votre cave a été créé avec succès !');

            return $this->redirectToRoute('app_cave');

        }
        

        return $this->render('cavecreate/cavecreate.html.twig', [
            'caveform'=>$form->createView(),
        ]);
    }
}
