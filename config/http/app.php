<?php

declare(strict_types=1);

use App\Http\Application;
use App\Http\ControllerResolver;
use App\Http\ServerRequestHandler;
use App\Http\ServerRequestMiddlewares;
use Psr\Http\Server\RequestHandlerInterface;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;
use Slon\Http\Kernel\Contract\ApplicationInterface;
use Slon\Http\Kernel\Contract\SapiEmmiterInterface;
use Slon\Http\Kernel\SapiEmmiter;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(ControllerResolver::class))
            ->addArgument('container', new Reference('container')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ServerRequestHandler::class, RequestHandlerInterface::class))
            ->addArgument('resolver', new Reference(ControllerResolver::class))
            ->addArgument('router', new Reference('router')),
    );
    
    $registry->addMeta(
        (new MetaInstance(Application::class, ApplicationInterface::class))
            ->addArgument('middlewares', new Reference(ServerRequestMiddlewares::class))
            ->addArgument('requestHandler', new Reference(RequestHandlerInterface::class)),
    );
    
    $registry->addMeta(
        (new MetaInstance(SapiEmmiter::class, SapiEmmiterInterface::class)),
    );
    
};
