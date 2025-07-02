<?php

declare(strict_types=1);

use App\Http\AuthMiddleware;
use App\Http\ServerRequestMiddlewares;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(ServerRequestMiddlewares::class)),
    );
    
    /** @var ServerRequestMiddlewares $middlewares */
    $middlewares = $registry->get(ServerRequestMiddlewares::class);
    
    $middlewares->addMiddleware(
        new AuthMiddleware(),
    );
    
};
