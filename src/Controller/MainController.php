<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/newgame', name: 'app_game')]
    public function newGame(CardRepository $cardRepository): Response
    {
        $game = new Game();
        $cards = $cardRepository->findAll();
        $game->setPlayer($this->getUser()->getId());
        shuffle($cards);


        $game->addCardsPlayer($cards[0]);
        $game->addCardsPlayer($cards[1]);
        $game->addCardsPlayer($cards[2]);

        $game->addCardCpu($cards[0]);
        $game->addCardCpu($cards[0]);
        $game->addCardCpu($cards[0]);




        return $this->render('main/game.html.twig', [
            'controller_name' => 'MainController',
            'game' => $game,
        ]);
    }
}
