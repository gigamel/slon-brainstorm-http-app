<?php

declare(strict_types=1);

use App\Http\Application;
use App\Http\ControllerResolver;
use App\Http\ServerRequestHandler;
use App\Http\ServerRequestMiddlewares;
use Psr\Http\Server\RequestHandlerInterface;
use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;
use Slon\Container\Reference;
use Slon\Http\Kernel\Contract\ApplicationInterface;
use Slon\Http\Kernel\Contract\SapiEmmiterInterface;
use Slon\Http\Kernel\SapiEmmiter;

return static function (RegistryInterface $registry): void {
    
    $registry->add(
        (new Instance(ControllerResolver::class))
            ->argument('container', new Reference('container')),
    );
    
    $registry->add(
        (new Instance(ServerRequestHandler::class, RequestHandlerInterface::class))
            ->argument('resolver', new Reference(ControllerResolver::class))
            ->argument('router', new Reference('router')),
    );
    
    $registry->add(
        (new Instance(Application::class, ApplicationInterface::class))
            ->argument('middlewares', new Reference(ServerRequestMiddlewares::class))
            ->argument('requestHandler', new Reference(RequestHandlerInterface::class)),
    );
    
    $registry->add(
        (new Instance(SapiEmmiter::class, SapiEmmiterInterface::class)),
    );
    
};
