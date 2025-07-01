<?php

declare(strict_types=1);

use App\Controller\Auth\LoginController;
use App\Controller\Blog\ListController;
use App\Controller\Blog\PostController;
use App\Controller\Site\ContactController;
use App\Controller\Site\ErrorController;
use App\Controller\Site\SiteController;
use App\Service\Blog\PostRepository;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(SiteController::class))
            ->addArgument('renderer', new Reference('renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ContactController::class))
            ->addArgument('renderer', new Reference('renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ErrorController::class))
            ->addArgument('renderer', new Reference('renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(LoginController::class))
            ->addArgument('renderer', new Reference('renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ListController::class))
            ->addArgument('renderer', new Reference('renderer'))
            ->addArgument('repository', new Reference(PostRepository::class))
            ->addArgument('routes', new Reference('routes')),
    );
    
    $registry->addMeta(
        (new MetaInstance(PostController::class))
            ->addArgument('renderer', new Reference('renderer'))
            ->addArgument('repository', new Reference(PostRepository::class)),
    );
    
};
