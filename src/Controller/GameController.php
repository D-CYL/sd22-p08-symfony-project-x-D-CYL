<?php

namespace App\Controller;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->findAll();
        return $this->render('game/index.html.twig', [
            'game' => $game,
        ]);
    }
    #[Route('/game/{game}', name: 'app_game_info')]
    public function game(EntityManagerInterface $entityManager, $game): Response
    {

        $info = $entityManager->getRepository(Game::class)->find($game);
        return $this->render('game/info.html.twig', [
            'info' => $info,
        ]);
    }
}
