<?php

declare(strict_types=1);

use App\Container\Container;
use App\Http\AuthMiddleware;
use App\Http\ServerRequestMiddlewares;

return static function (Container $container): void {
    
    $container->add(
        ServerRequestMiddlewares::class,
        static function (Container $container): ServerRequestMiddlewares {
            return new ServerRequestMiddlewares([
                new AuthMiddleware(),
            ]);
        },
    );
    
};
