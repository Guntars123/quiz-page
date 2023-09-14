<?php declare(strict_types=1);

namespace App\Models;

class UserTest
{
    private int $id;
    private int $username;
    private int $test_id;
    private int $score;
    private string $created_at;

    public function __construct($id, $username, $test_id, $score, $created_at)
    {
        $this->id = $id;
        $this->username = $username;
        $this->test_id = $test_id;
        $this->score = $score;
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): int
    {
        return $this->username;
    }

    public function getTestId(): int
    {
        return $this->test_id;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}
