<?php

declare(strict_types=1);

use App\Container\Config;
use App\Container\Container;
use App\Http\Application;
use App\Http\ControllerResolver;
use App\Http\ServerRequestHandler;
use App\Http\ServerRequestMiddlewares;
use Psr\Http\Server\RequestHandlerInterface;
use Slon\Http\Kernel\Contract\ApplicationInterface;
use Slon\Http\Kernel\Contract\SapiEmmiterInterface;
use Slon\Http\Kernel\SapiEmmiter;
use Slon\Http\Router\Contract\RouterInterface;

return static function (Container $container): void {
    
    $container->add(ApplicationInterface::class, static function (Container $container): ApplicationInterface {
        return new Application(
            $container->get(ServerRequestMiddlewares::class),
            $container->get(RequestHandlerInterface::class),
        );
    });
    
    $container->add(Config::class, static function (Container $container): Config {
        return new Config();
    });
    
    $container->add(ControllerResolver::class, static function (Container $container): ControllerResolver {
        return new ControllerResolver($container);
    });
    
    $container->add(RequestHandlerInterface::class, static function (Container $container): RequestHandlerInterface {
        return new ServerRequestHandler(
            $container->get(ControllerResolver::class),
            $container->get(RouterInterface::class),
        );
    });
    
    $container->add(SapiEmmiterInterface::class, static function (Container $container): SapiEmmiterInterface {
        return new SapiEmmiter();
    });
    
};
