<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Repositories\UserTestRepository;

class TestController
{
    private UserTestRepository $userTestRepository;

    public function __construct(UserTestRepository $userTestRepository)
    {
        $this->userTestRepository = $userTestRepository;
    }

    public function index(): View
    {
        $test = $this->userTestRepository->findByUsername('AA');

        return new View("index", ['test' => $test]);
    }
}


