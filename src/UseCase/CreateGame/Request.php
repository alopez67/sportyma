<?php

namespace App\UseCase\CreateGame;

final class Request
{
    /**
     * @param string $gameName
     * @param string $homeTeamName
     * @param string $awayTeamName
     */
    public function __construct(
        private readonly string $gameName,
        private readonly string $homeTeamName,
        private readonly string $awayTeamName,
    )
    {
    }

    /**
     * @return string
     */
    public function getGameName()
    {
        return $this->gameName;
    }

    /**
     * @return string
     */
    public function getHomeTeamName()
    {
        return $this->homeTeamName;
    }

    /**
     * @return string
     */
    public function getAwayTeamName()
    {
        return $this->awayTeamName;
    }
}