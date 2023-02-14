<?php

namespace App\Domain\Repository;

use App\Domain\Entity\EntityInterface;

interface RepositoryInterface
{
    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function create(EntityInterface $entity): void;

    /**
     * @return void
     */
    public function save(): void;
}