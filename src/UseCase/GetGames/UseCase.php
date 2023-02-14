<?php

namespace App\UseCase\GetGames;

use App\Domain\Repository\GameRepository;
use App\Domain\Repository\TeamRepository;

final class UseCase
{
    public function __construct(
        private readonly TeamRepository $teamRepository,
        private readonly GameRepository $gameRepository)
    {
    }

    public function execute(Request $request): Response
    {
        if ($teamName = $request->getTeamName()) {
            $team = $this->teamRepository->findOneBy([
                'name' => $teamName
            ]);

            $games = $team->getAllGames();
        } else {
            $games = $this->gameRepository->findAll();
        }

        return new Response($games);
    }
}