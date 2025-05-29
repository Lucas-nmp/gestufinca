<?php

namespace App\Controller;

use App\Entity\Neighbor;
use App\Form\NeighborForm;
use App\Repository\NeighborRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/neighbor')]
final class NeighborController extends AbstractController
{
    #[Route(name: 'app_neighbor_index', methods: ['GET'])]
    public function index(NeighborRepository $neighborRepository): Response
    {
        return $this->render('neighbor/index.html.twig', [
            'neighbors' => $neighborRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_neighbor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $neighbor = new Neighbor();
        $form = $this->createForm(NeighborForm::class, $neighbor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($neighbor);
            $entityManager->flush();

            return $this->redirectToRoute('app_neighbor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('neighbor/new.html.twig', [
            'neighbor' => $neighbor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_neighbor_show', methods: ['GET'])]
    public function show(Neighbor $neighbor): Response
    {
        return $this->render('neighbor/show.html.twig', [
            'neighbor' => $neighbor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_neighbor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Neighbor $neighbor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NeighborForm::class, $neighbor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_neighbor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('neighbor/edit.html.twig', [
            'neighbor' => $neighbor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_neighbor_delete', methods: ['POST'])]
    public function delete(Request $request, Neighbor $neighbor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$neighbor->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($neighbor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_neighbor_index', [], Response::HTTP_SEE_OTHER);
    }
}
