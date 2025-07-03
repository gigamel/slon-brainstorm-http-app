<?php

declare(strict_types=1);

use App\Http\AuthMiddleware;
use App\Http\ServerRequestMiddlewares;
use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;

return static function (RegistryInterface $registry): void {
    
    $registry->add(
        (new Instance(ServerRequestMiddlewares::class)),
    );
    
    /** @var ServerRequestMiddlewares $middlewares */
    $middlewares = $registry->get(ServerRequestMiddlewares::class);
    
    $middlewares->addMiddleware(
        new AuthMiddleware(),
    );
    
};
