<?php

namespace App\UseCase\CreateGame;

use App\Domain\Entity\Game;
use App\Domain\Repository\GameRepository;
use App\Domain\Repository\TeamRepository;

class UseCase
{
    /**
     * @param TeamRepository $teamRepository
     * @param GameRepository $gameRepository
     */
    public function __construct(
        private readonly TeamRepository $teamRepository,
        private readonly GameRepository $gameRepository)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request): Response
    {
        $teamHome = $this->teamRepository->findOneBy([
            'name' => [
                $request->getHomeTeamName(),
            ]
        ]);

        $teamAway = $this->teamRepository->findOneBy([
            'name' => [
                $request->getAwayTeamName(),
            ]
        ]);

        $game = new Game($request->getGameName(), $teamHome, $teamAway);
        $this->gameRepository->create($game);

        return new Response($game);
    }
}