<?php

declare(strict_types=1);

use App\Container\Container;
use App\Controller\Admin\DashboardController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoutController;
use App\Controller\Blog\ListController;
use App\Controller\Blog\PostController;
use App\Controller\Site\ContactController;
use App\Controller\Site\ErrorController;
use App\Controller\Site\SiteController;
use App\Service\Blog\PostRepository;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Renderer\Contract\RendererCompositeInterface;

return static function (Container $container): void {
    
    $container->add(SiteController::class, static function (Container $container): SiteController {
        return new SiteController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
    $container->add(ContactController::class, static function (Container $container): ContactController {
        return new ContactController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
    $container->add(ErrorController::class, static function (Container $container): ErrorController {
        return new ErrorController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
    $container->add(LoginController::class, static function (Container $container): LoginController {
        return new LoginController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
    $container->add(LogoutController::class, static function (Container $container): LogoutController {
        return new LogoutController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
    $container->add(ListController::class, static function (Container $container): ListController {
        return new ListController(
            $container->get(RendererCompositeInterface::class),
            $container->get(PostRepository::class),
            $container->get(RoutesCollectionInterface::class),
        );
    });
    
    $container->add(PostController::class, static function (Container $container): PostController {
        return new PostController(
            $container->get(RendererCompositeInterface::class),
            $container->get(PostRepository::class),
        );
    });
    
    $container->add(DashboardController::class, static function (Container $container): DashboardController {
        return new DashboardController(
            $container->get(RendererCompositeInterface::class),
        );
    });
    
};
