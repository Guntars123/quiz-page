<?php declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\TestController;

return
    [
        ['GET','/', [HomeController::class, 'index']],
        ['POST', '/', [HomeController::class, 'startTest']],
        ['GET', '/test/{id:\d+}', [TestController::class, 'showTest']],
        ['POST', '/test/{id:\d+}', [TestController::class, 'test']],
        ['GET', 'test/{id:\d+}/result', [HomeController::class, 'result']],
    ];

