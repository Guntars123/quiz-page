<?php declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\ResultController;
use App\Controllers\TestController;

return
    [
        ['GET','/', [HomeController::class, 'index']],
        ['POST', '/', [HomeController::class, 'testSelection']],
        ['GET', '/test/{id:\d+}', [TestController::class, 'showTest']],
        ['POST', '/test/{id:\d+}/submit', [TestController::class, 'submitAnswers']],
        ['GET', '/test/{id:\d+}/results', [ResultController::class, 'showResults']],
    ];

