<?php

namespace App\UseCase\GetGames;

final class Response
{
    public function __construct(private readonly array $games)
    {
    }

    public function getGames(): array
    {
        return $this->games;
    }
}