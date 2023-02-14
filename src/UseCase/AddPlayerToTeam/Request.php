<?php

namespace App\UseCase\AddPlayerToTeam;

final class Request
{
    /**
     * @param string $teamName
     * @param string $playerId
     */
    public function __construct(
        private readonly string $teamName,
        private readonly string $playerId
    )
    {
    }

    /**
     * @return string
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }
}