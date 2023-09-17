<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\QuestionRepository;
use App\Core\View;

class TestController
{
    private QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function showTest(array $vars): View
    {
        $testId = (int)$vars['id'];

        $questions = $this->questionRepository->getQuestionsByTestId($testId);
        $questionCount = $this->questionRepository->getQuestionCountByTestId($testId);

        return new View('showTest', [
            'questions' => $questions,
            'questionCount' => $questionCount,
            'testId' => $testId,
        ]);
    }
}
