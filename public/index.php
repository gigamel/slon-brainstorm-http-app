<?php

declare(strict_types=1);

use App\Controller\Site\ErrorController;
use App\Kernel;
use App\Provider\ArrayConfigsProvider;
use Slon\Container\Container;
use Slon\Container\MetaRegistry;
use Slon\Http\Protocol\Factory\ServerRequestFactory;
use Slon\Http\Router\Contract\RouterInterface;
use Slon\Http\Router\Contract\RouteShardInterface;
use Slon\Http\Router\Exception\RouteNotFoundException;

require_once __DIR__ . '/../vendor/autoload.php';

if ('cli' === \php_sapi_name()) {
    throw new RuntimeException('The application cannot be run in the SAPI Cli');
}

$kernel = new Kernel(dirname(__DIR__));

$registry = new MetaRegistry(
    (new ArrayConfigsProvider(
        $kernel->pwd('kernel/common/*.php'),
        $kernel->pwd('kernel/http/*.php'),
    ))->getArray(),
);

$kernel->import(
    $kernel->pwd('config/*.php'),
    $kernel->pwd('extension/*.php'),
)->withArgs($registry);

$container = new Container($registry);

$kernel->import(
    $kernel->pwd('routes/*.php'),
)->withArgs($container->get('routes'));

$request = ServerRequestFactory::fromGlobals();

try {
    /**
     * @var RouterInterface $router
     */
    $router = $container->get('router');

    /**
     * @var RouteShardInterface $routeShard
     */
    $routeShard = $router->handleRequest($request);
    foreach ($routeShard->getSegments() as $name => $value) {
        $request = $request->withAttribute($name, $value);
    }

    $handler = $routeShard->getHandler();
} catch (RouteNotFoundException) {
    $handler = ErrorController::class;
}

if ($container->has($handler)) {
    $controller = $container->get($handler);
} else {
    $container = new $handler();
}

$response = $controller($request);

$container->get('sapi_emmiter')->emmit($response);
