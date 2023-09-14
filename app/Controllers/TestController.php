<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class TestController
{
    public function index(): View
    {
        $test = "this works";

        return new View("index", ['test' => $test]);
    }
}


