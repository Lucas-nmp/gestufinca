<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\NewsRepository;
use App\Repository\OpinionsRepository;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newsRepository, OpinionsRepository $opinionRepository): Response
    {
        // Fetching the latest news items to display on the home page
        $latestNews = $newsRepository->findBy([], ['id' => 'DESC'], 6);
    
        
        // Do the same with opinions
        $latestOpinions = $opinionRepository->findBy([], ['id' => 'DESC'], 6);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'latestNews' => $latestNews,
            'latestOpinions' => $latestOpinions,
        ]);
    }
}
