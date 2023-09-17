<?php declare(strict_types=1);

namespace App\Models;

class Question
{
    private int $id;
    private string $text;
    private int $test_id;
    private array $options;

    public function __construct($id, $text, $test_id, $options)
    {
        $this->id = $id;
        $this->text = $text;
        $this->test_id = $test_id;
        $this->options = $options;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTestId(): int
    {
        return $this->test_id;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
