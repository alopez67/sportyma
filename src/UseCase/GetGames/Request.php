<?php

namespace App\UseCase\GetGames;

final class Request
{
    public function __construct(private readonly ?string $teamName)
    {
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }
}