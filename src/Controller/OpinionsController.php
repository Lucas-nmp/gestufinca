<?php

namespace App\Controller;

use App\Entity\Opinions;
use App\Form\OpinionsForm;
use App\Repository\OpinionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/opinions')]
final class OpinionsController extends AbstractController
{
    #[Route(name: 'app_opinions_index', methods: ['GET'])]
    public function index(OpinionsRepository $opinionsRepository): Response
    {
        return $this->render('opinions/index.html.twig', [
            'opinions' => $opinionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_opinions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $opinion = new Opinions();
        $form = $this->createForm(OpinionsForm::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($opinion);
            $entityManager->flush();

            return $this->redirectToRoute('app_opinions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opinions/new.html.twig', [
            'opinion' => $opinion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opinions_show', methods: ['GET'])]
    public function show(Opinions $opinion): Response
    {
        return $this->render('opinions/show.html.twig', [
            'opinion' => $opinion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_opinions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Opinions $opinion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OpinionsForm::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_opinions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opinions/edit.html.twig', [
            'opinion' => $opinion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opinions_delete', methods: ['POST'])]
    public function delete(Request $request, Opinions $opinion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opinion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($opinion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_opinions_index', [], Response::HTTP_SEE_OTHER);
    }
}
