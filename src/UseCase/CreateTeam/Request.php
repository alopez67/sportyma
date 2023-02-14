<?php

namespace App\UseCase\CreateTeam;

final class Request
{
    /**
     * @param string $name
     */
    public function __construct(private readonly string $name)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}