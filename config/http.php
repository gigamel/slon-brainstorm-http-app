<?php

declare(strict_types=1);

use App\Http\Application;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;
use Slon\Http\Kernel\Contract\ApplicationInterface;
use Slon\Http\Kernel\Contract\SapiEmmiterInterface;
use Slon\Http\Kernel\SapiEmmiter;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(Application::class, ApplicationInterface::class))
            ->addArgument('router', new Reference('router')),
    );
    
    $registry->addMeta(
        (new MetaInstance(SapiEmmiter::class, SapiEmmiterInterface::class)),
    );
    
};
