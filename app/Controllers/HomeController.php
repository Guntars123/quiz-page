<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Validator;
use App\Repositories\TestRepository;
use App\Core\View;
use App\Repositories\UserTestRepository;

class HomeController
{
    private TestRepository $testRepository;
    private UserTestRepository $userTestRepository;
    private Validator $validator;


    public function __construct
    (
        TestRepository     $testRepository,
        UserTestRepository $userTestRepository,
        Validator          $validator
    )
    {
        $this->testRepository = $testRepository;
        $this->userTestRepository = $userTestRepository;
        $this->validator = $validator;
    }

    public function index(): View
    {
        $tests = $this->testRepository->getAll();

        return new View('index', ['tests' => $tests]);
    }

    public function startTest(): void
    {
        $this->validator->validateStartTestForm($_POST);

        $username = $_POST['username'];

        $testId = (int)$_POST['testId'];

        $this->userTestRepository->save($username, $testId);

        header("Location: /test/$testId");
        exit();
    }
}