<?php

namespace App\UseCase\AddPlayerToTeam;

use App\Domain\Repository\PlayerRepository;
use App\Domain\Repository\TeamRepository;

final class UseCase
{
    /**
     * @param TeamRepository $teamRepository
     * @param PlayerRepository $playerRepository
     */
    public function __construct(
        private readonly TeamRepository $teamRepository,
        private readonly PlayerRepository $playerRepository)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request): Response
    {
        $team = $this->teamRepository->findOneBy([
            'name' => $request->getTeamName()
        ]);

        $team->addPlayer(
            $this->playerRepository->find($request->getPlayerId())
        );

        $this->teamRepository->save();

        return new Response($team);
    }
}