<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\QuestionRepository;
use App\Repositories\TestRepository;
use App\Repositories\UserTestRepository;
use App\Core\View;

class TestController
{
    private TestRepository $testRepository;
    private QuestionRepository $questionRepository;
    private UserTestRepository $userTestRepository;


    public function __construct
    (
        TestRepository     $testRepository,
        QuestionRepository $questionRepository,
        UserTestRepository $userTestRepository
    )
    {
        $this->testRepository = $testRepository;
        $this->questionRepository = $questionRepository;
        $this->userTestRepository = $userTestRepository;
    }

    public function showTest(array $vars): View
    {
        $testId = (int)$vars['id'];

        $test = $this->testRepository->getTestById($testId);
        $questions = $this->questionRepository->getQuestionsByTestId($testId);
        $questionCount = $this->questionRepository->getQuestionCountByTestId($testId);


        return new View('showTest', [
            'test' => $test,
            'questions' => $questions,
            'questionCount' => $questionCount,
            'testId' => $testId,
        ]);
    }

    public function submitAnswers(array $vars): void
    {
        $testId = (int)$vars['id'];

        $questionsCount = $this->questionRepository->getQuestionCountByTestId($testId);

        $submittedAnswers = $_POST['answers'] ?? [];

        $correctAnswers = 0;

        foreach ($submittedAnswers as $questionId => $selectedOptionId) {
            $correctOptionId = $this->questionRepository->getCorrectOptionIdByQuestionId($questionId);

            if ($selectedOptionId == $correctOptionId) {
                $correctAnswers++;
            }
        }

        $userTestId = $this->userTestRepository->saveUserTest($_SESSION['username'], $testId, $correctAnswers);

        foreach ($submittedAnswers as $questionId => $selectedOptionId) {
            $this->userTestRepository->saveUserAnswers($userTestId, $questionId, $selectedOptionId);
        }

        $_SESSION['correctAnswersCount'] = $correctAnswers;
        $_SESSION['totalQuestionsCount'] = $questionsCount;

        header('Location: /test/' . $testId . '/results');
    }
}
