<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newsRepository): Response
    {
        // Fetching the latest news items to display on the home page
        $latestNews = $newsRepository->findBy([], ['id' => 'DESC'], 6);
        // Render the home page with the latest news

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'latestNews' => $latestNews,
            'newsCount' => $newsRepository->count([]),
        ]);
    }
}
