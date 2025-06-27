<?php

declare(strict_types=1);

use App\Controller\ErrorController;
use App\Controller\SiteController;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(SiteController::class))
            ->addArgument('renderer', new Reference('tpl_renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ErrorController::class))
            ->addArgument('renderer', new Reference('tpl_renderer')),
    );
    
};
