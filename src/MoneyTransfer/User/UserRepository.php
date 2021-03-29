<?php

namespace App\MoneyTransfer\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Infra\RepositoryTrait;
use App\MoneyTransfer\Transfer\ShopkeeperNotTransferMoneyException;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByCpf(string $cpf): User
    {
        $user = $this->findOneBy(['cpf' => $cpf]);
        if (!($user instanceof User)) {
            throw UserNotFoundException::userWithThisCpfNotFound($cpf);
        }

        return $user;
    }

    public function findUserByCpf(string $cpf): User
    {
        $user = $this->findOneBy(['cpf' => $cpf]);
        if (!($user instanceof User)) {
            throw UserNotFoundException::userWithThisCpfNotFound($cpf);
        }

        if ($user->getRoles() === 'ROLE_SHOPKEEPER') {
            throw ShopkeeperNotTransferMoneyException::shopkeeperNotTransferMoney(
                $user->getName(),
                $user->getCpf(),
            );
        }

        return $user;
    }
}
