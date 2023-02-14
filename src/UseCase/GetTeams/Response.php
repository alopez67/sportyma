<?php

namespace App\UseCase\GetTeams;

final class Response
{
    public function __construct(private readonly array $teams)
    {
    }

    public function getTeams(): array
    {
        return $this->teams;
    }
}