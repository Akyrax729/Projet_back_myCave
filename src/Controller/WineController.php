<?php

namespace App\Controller;

use App\Entity\Cave;
use App\Entity\User;
use App\Entity\Wine;
use App\Form\WineType;
use App\Repository\WineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/wine')]
final class WineController extends AbstractController{
    #[Route(name: 'app_wine_index', methods: ['GET'])]
    public function index(WineRepository $wineRepository): Response
    {
        return $this->render('wine/index.html.twig', [
            'wines' => $wineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_wine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wine = new Wine();
        $form = $this->createForm(WineType::class, $wine);
        $form->handleRequest($request);

        $user = $this->getUser();
        $cave = $entityManager->getRepository(Cave::class)->findOneBy(['user' => $user]); 

        if (!$cave) {
            $cave = new Cave();
            $cave->setUser($user);
            $cave->setName('Cave de ' . $user->getUsername());
            $cave->setDescription('Cave de ' . $user->getUsername());
            $user->setCave($cave);
            $entityManager->persist($cave);
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $wine->setCave($cave);
            $entityManager->persist($wine);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('wine/new.html.twig', [
            'wine' => $wine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_wine_show', methods: ['GET'])]
    public function show(Wine $wine): Response
    {
        return $this->render('wine/show.html.twig', [
            'wine' => $wine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_wine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Wine $wine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WineType::class, $wine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('wine/edit.html.twig', [
            'wine' => $wine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_wine_delete', methods: ['POST'])]
    public function delete(Request $request, Wine $wine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($wine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
    }
}
