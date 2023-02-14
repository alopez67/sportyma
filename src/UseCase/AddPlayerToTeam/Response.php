<?php

namespace App\UseCase\AddPlayerToTeam;

use App\Domain\Entity\Team;

final class Response
{
    /**
     * @param Team $team
     */
    public function __construct(private readonly Team $team)
    {
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}