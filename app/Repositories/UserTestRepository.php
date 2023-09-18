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

    public function saveUserTest($username, $testId, $correctAnswers): int
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
            ->setParameter('score', $correctAnswers)
            ->setParameter('created_at', date('Y-m-d H:i:s'));

        $queryBuilder->executeQuery();

        $userTestId = $this->connection->lastInsertId();

        return (int)$userTestId;
    }


    public function saveUserAnswers($userTestId, $questionId, $optionId): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->insert('user_answers')
            ->values(
                [
                    'user_test_id' => ':user_test_id',
                    'question_id' => ':question_id',
                    'option_id' => ':option_id',
                ]
            )
            ->setParameter('user_test_id', $userTestId)
            ->setParameter('question_id', $questionId)
            ->setParameter('option_id', $optionId);

        $queryBuilder->executeQuery();
    }
}


