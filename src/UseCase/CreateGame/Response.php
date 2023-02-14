<?php

namespace App\UseCase\CreateGame;

use App\Domain\Entity\Game;

final class Response
{
    /**
     * @param Game $game
     */
    public function __construct(private readonly Game $game)
    {
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }
}