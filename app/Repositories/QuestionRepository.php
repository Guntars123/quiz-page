<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Option;
use Doctrine\DBAL\Connection;
use App\Models\Question;

class QuestionRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getQuestionsByTestId(int $testId): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('questions')
            ->where('test_id = :test_id')
            ->setParameter('test_id', $testId);

        $questions = $queryBuilder->executeQuery()->fetchAllAssociative();

        $questionsCollection = [];

        foreach ($questions as $question) {
            $questionsCollection[] = $this->buildModel($question);
        }
        return $questionsCollection;
    }

    public function getQuestionCountByTestId(int $testId): string
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('COUNT(*)')
            ->from('questions')
            ->where('test_id = :test_id')
            ->setParameter('test_id', $testId);

        return $queryBuilder->executeQuery()->fetchOne();
    }

    public function getCorrectOptionIdByQuestionId(int $questionId): string
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('id')
            ->from('options')
            ->where('question_id = :question_id')
            ->andWhere('is_correct = 1')
            ->setParameter('question_id', $questionId);

        return $queryBuilder->executeQuery()->fetchOne();
    }

    private function buildModel(array $questions): Question
    {
        return new Question(
            (int)$questions['id'],
            (string)$questions['text'],
            (int)$questions['test_id'],
            $this->getOptionsByQuestionId((int)$questions['id'])
        );
    }


    private function getOptionsByQuestionId(int $questionId): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('options')
            ->where('question_id = :question_id')
            ->setParameter('question_id', $questionId);

        $options = $queryBuilder->executeQuery()->fetchAllAssociative();

        $optionsCollection = [];

        foreach ($options as $option) {
            $optionsCollection[] = $this->buildOptionModel($option);
        }
        return $optionsCollection;
    }

    private function buildOptionModel(array $data): Option
    {
        return new Option(
            (int)$data['id'],
            (string)$data['text'],
            (int)$data['question_id'],
            (int)$data['is_correct']
        );
    }
}

