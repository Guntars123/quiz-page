<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Repositories\TestRepository;

class ResultController
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function showResults(array $vars): View
    {
        $testId = (int)$vars['id'];

        $test = $this->testRepository->getTestById($testId);


        $username = $_SESSION['username'];
        $correctAnswersCount = $_SESSION['correctAnswersCount'];
        $totalQuestionsCount = $_SESSION['totalQuestionsCount'];


        return new View('showResults', [
            'test' => $test,
            'username' => $username,
            'correctAnswersCount' => $correctAnswersCount,
            'totalQuestionsCount' => $totalQuestionsCount,
        ]);
    }


}