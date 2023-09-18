<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Repositories\QuestionRepository;
use App\Repositories\UserTestRepository;

class ResultController
{
    private UserTestRepository $userTestRepository;
    private QuestionRepository $questionRepository;

    public function __construct(UserTestRepository $userTestRepository, QuestionRepository $questionRepository)
    {
        $this->userTestRepository = $userTestRepository;
        $this->questionRepository = $questionRepository;
    }

    public function showResults(array $vars): View
    {
        $testId = (int)$vars['id'];

        // Assuming you save the result data in session (or any other method you prefer)
        $username = $_SESSION['username'];
        $correctAnswersCount = $_SESSION['correctAnswersCount'];
        $totalQuestionsCount = $_SESSION['totalQuestionsCount'];


        return new View('showResults', [
            'username' => $username,
            'correctAnswersCount' => $correctAnswersCount,
            'totalQuestionsCount' => $totalQuestionsCount,
        ]);
    }


}