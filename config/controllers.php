<?php

declare(strict_types=1);

use App\Controller\Blog\ListController;
use App\Controller\ErrorController;
use App\Controller\SiteController;
use App\Service\Blog\PostRepository;
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
    
    $registry->addMeta(
        (new MetaInstance(ListController::class))
            ->addArgument('renderer', new Reference('tpl_renderer'))
            ->addArgument('repository', new Reference(PostRepository::class))
            ->addArgument('routes', new Reference('routes')),
    );
    
};
