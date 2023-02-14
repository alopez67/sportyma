<?php

namespace App\UseCase\CreateTeam;

use App\Domain\Entity\Team;
use App\Domain\Repository\TeamRepository;

final class UseCase
{
    /**
     * @param TeamRepository $teamRepository
     */
    public function __construct(private readonly TeamRepository $teamRepository)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request): Response
    {
        $team = new Team($request->getName());
        $this->teamRepository->create($team);

        return new Response($team->getId());
    }
}