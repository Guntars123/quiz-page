<?php declare(strict_types=1);

namespace App\Models;

class UserAnswer
{
    private int $user_test_id;
    private int $question_id;
    private int $option_id;

    public function __construct($user_test_id, $question_id, $option_id)
    {
        $this->user_test_id = $user_test_id;
        $this->question_id = $question_id;
        $this->option_id = $option_id;
    }

    public function getUserTestId(): int
    {
        return $this->user_test_id;
    }

    public function getQuestionId(): int
    {
        return $this->question_id;
    }

    public function getOptionId(): int
    {
        return $this->option_id;
    }
}
