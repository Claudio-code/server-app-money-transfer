<?php

namespace App\Infra;

trait RepositoryTrait
{
    public function lock(object $entity): void
    {
        $this->getEntityManager()->lock($entity, \Doctrine\DBAL\LockMode::PESSIMISTIC_READ);
        $this->getEntityManager()->refresh($entity);
    }

    public function beginTransaction(): void
    {
        $this
            ->getEntityManager()
            ->getConnection()
            ->beginTransaction();
    }

    public function rollBack(): void
    {
        $this
            ->getEntityManager()
            ->getConnection()
            ->rollBack();
    }

    public function commit(): void
    {
        $this
            ->getEntityManager()
            ->getConnection()
            ->commit();
    }

    public function persist(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
