<?php declare(strict_types=1);

namespace App\Core;

class Validator
{
    private array $errors = [];
    private array $fields = [];

    public function validateStartTestForm(array $fields = []): void
    {

        $this->fields = $fields;

        foreach ($fields as $field => $value) {
            $methodName = 'validate' . ucfirst($field);

            if (method_exists($this, $methodName)) {
                $this->{$methodName}();
            }
        }

        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validateUsername(): void
    {
        $userName = $this->fields['username'];

        if (empty($userName)) {
            $this->errors['username'][] = 'Username are required.';
        }
    }
}
