<?php

declare(strict_types=1);

use App\HttpKernel;

require_once __DIR__ . '/../vendor/autoload.php';

(new HttpKernel(dirname(__DIR__)))->run();
