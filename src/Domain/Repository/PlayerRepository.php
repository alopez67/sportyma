<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Player;

interface PlayerRepository extends RepositoryInterface
{
    /**
     * @return array<Player>
     */
    public function findAll(): array;
}