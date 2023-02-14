<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function create(EntityInterface $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $this->_em->flush();
    }
}