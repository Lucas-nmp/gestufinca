<?php

namespace App\Controller;

use App\Entity\Information;
use App\Form\InformationForm;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;    

#[Route('/information')]
final class InformationController extends AbstractController
{
    #[Route(name: 'app_information_index', methods: ['GET'])]
    public function index(InformationRepository $informationRepository): Response
    {
        return $this->render('information/index.html.twig', [
            'information' => $informationRepository->findAll(),
        ]);
    }

    #[Route(name: 'app_community_information', methods: ['GET'])]
    public function community_information(InformationRepository $informationRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof \App\Entity\User || !$user->getCommunity()) {
            throw $this->createAccessDeniedException('No tienes una comunidad asignada.');
        }


        // Obtener la comunidad del usuario
        $community = $user->getCommunity();

        // Obtener informaciones solo de esa comunidad
        $informations = $informationRepository->findBy(['community' => $community]);

        return $this->render('information/index.html.twig', [
            'information' => $informations,
        ]);
    }


    #[Route('/new', name: 'app_information_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $information = new Information();
        $form = $this->createForm(InformationForm::class, $information);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($information);
            $entityManager->flush();

            return $this->redirectToRoute('app_information_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('information/new.html.twig', [
            'information' => $information,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_information_show', methods: ['GET'])]
    public function show(Information $information): Response
    {
        return $this->render('information/show.html.twig', [
            'information' => $information,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_information_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Information $information, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InformationForm::class, $information);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_information_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('information/edit.html.twig', [
            'information' => $information,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_information_delete', methods: ['POST'])]
    public function delete(Request $request, Information $information, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$information->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($information);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_information_index', [], Response::HTTP_SEE_OTHER);
    }
}
