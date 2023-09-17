<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\UserTestRepository;

class ResultController
{
    private UserTestRepository $userTestRepository;

    public function __construct(UserTestRepository $userTestRepository)
    {
        $this->userTestRepository = $userTestRepository;
    }

    //////
}