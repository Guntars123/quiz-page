<?php declare(strict_types=1);

namespace App\Models;

class Option
{
    private int $id;
    private string $text;
    private int $question_id;
    private int $is_correct;

    public function __construct($id, $text, $question_id, $is_correct) {
        $this->id = $id;
        $this->text = $text;
        $this->question_id = $question_id;
        $this->is_correct = $is_correct;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getQuestionId(): int {
        return $this->question_id;
    }

    public function getIsCorrect(): int {
        return $this->is_correct;
    }
}
