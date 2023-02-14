<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Team;

interface TeamRepository extends RepositoryInterface
{
    /**
     * @return array<Team>
     */
    public function findAll(): array;
}