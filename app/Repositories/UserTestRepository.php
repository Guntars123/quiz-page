<?php declare(strict_types=1);

namespace App\Repositories;

use Doctrine\DBAL\Connection;

class UserTestRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findByUsername(string $username): ?array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('user_tests')
            ->where('username = :username')
            ->setParameter('username', $username);

        return $queryBuilder->executeQuery()->fetchAssociative();
    }
}


