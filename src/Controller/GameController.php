<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\CategoryType;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create/game', name: 'game_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectToRoute('app_game');
        }


        return $this->render('game.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/game/{game}/edit', name: 'game_edit')]
    public function edit(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_game');
        }

        return $this->render('game.html.twig', [
            'form' => $form->createView(),
            'game' => $game,
        ]);
    }

    #[Route('/game/{game}/delete', name: 'game_delete')]
    public function delete(Game $game, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($game);
        $entityManager->flush();

        return $this->redirectToRoute('app_game');
    }
}
