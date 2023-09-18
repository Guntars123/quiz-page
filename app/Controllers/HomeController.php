<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\TestRepository;
use App\Core\Validator;
use App\Core\View;

class HomeController
{
    private TestRepository $testRepository;
    private Validator $validator;

    public function __construct
    (
        TestRepository $testRepository,
        Validator      $validator
    )
    {
        $this->testRepository = $testRepository;
        $this->validator = $validator;
    }

    public function index(): View
    {
        $tests = $this->testRepository->getAll();

        return new View('index', ['tests' => $tests]);
    }

    public function testSelection(): void
    {
        $this->validator->validateStartTestForm($_POST);

        if (count($this->validator->getErrors()) > 0) {
            header("Location: /");
            exit();
        }

        $username = $_POST['username'];

        $testId = (int)$_POST['testId'];

        $_SESSION['username'] = $username;

        header("Location: /test/$testId");
        exit();
    }
}