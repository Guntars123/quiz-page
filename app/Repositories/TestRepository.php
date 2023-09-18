<?php declare(strict_types=1);

namespace App\Repositories;

use Doctrine\DBAL\Connection;
use App\Models\Test;

class TestRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('tests');

        $tests = $queryBuilder->executeQuery()->fetchAllAssociative();

        $testsCollection = [];

        foreach ($tests as $test) {
            $testsCollection[] = $this->buildModel($test);
        }
        return $testsCollection;
    }

    public function getTestById(int $id): Test
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('tests')
            ->where('id = :id')
            ->setParameter('id', $id);

        $test = $queryBuilder->executeQuery()->fetchAssociative();

        return $this->buildModel($test);
    }

    private function buildModel(array $data): Test
    {
        return new Test(
            (int)$data['id'],
            (string)$data['name'],
            (string)$data['description']
        );
    }
}