<?php

namespace App\UseCase\CreateTeam;

final class Response
{
    /**
     * @param int $id
     */
    public function __construct(private readonly int $id)
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}