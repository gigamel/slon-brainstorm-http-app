<?php

declare(strict_types=1);

use App\Kernel;
use Slon\Container\Container;
use Slon\Container\MetaRegistry;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel(dirname(__DIR__));

$registry = new MetaRegistry();

$kernel->import($kernel->pwd('config/*.php'))->withArgs($registry);

$container = new Container($registry);

echo $container->get('tpl_renderer')->render('home.tpl');
