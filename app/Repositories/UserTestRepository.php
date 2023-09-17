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

    public function save($username, $testId):void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->insert('user_tests')
            ->values(
                [
                    'username' => ':username',
                    'test_id' => ':test_id',
                    'score' => ':score',
                    'created_at' => ':created_at'
                ]
            )
            ->setParameter('username', $username)
            ->setParameter('test_id', $testId)
            ->setParameter('score', 0)
            ->setParameter('created_at', date('Y-m-d H:i:s'));

        $queryBuilder->executeQuery();
    }
}


