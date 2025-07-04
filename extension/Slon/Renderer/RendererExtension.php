<?php

declare(strict_types=1);

namespace Extension\Slon\Renderer;

use App\Container\Config;
use Extension\Slon\Renderer\Extension\Blocks;
use Extension\Slon\Renderer\Extension\Pagination;
use Extension\Slon\Renderer\Extension\Route;
use Psr\Container\ContainerInterface;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Renderer\Contract\RendererCompositeInterface;
use Slon\Renderer\PhpRenderer;
use Slon\Renderer\QuotesExtension;

final class RendererExtension
{
    public function extends(
        ContainerInterface $container,
        array $configs = [],
    ): void {
        
        if (!$container->has(RendererCompositeInterface::class)) {
            return;
        }

        $renderer = $container->get(RendererCompositeInterface::class);
        
        $configs = $container->get(Config::class);

        $phpRenderer = new PhpRenderer();
        $phpRenderer->addExtension(new QuotesExtension());
        $phpRenderer->addExtension(
            new Pagination($configs->getOption('views.dir')),
        );

        $phpRenderer->addExtension(
            new Blocks($configs->getOption('views.dir')),
        );

        $renderer->addRenderer($phpRenderer);

        if ($container->has(RoutesCollectionInterface::class)) {
            $phpRenderer->addExtension(
                new Route($container->get(RoutesCollectionInterface::class)),
            );
        }
        
    }
}
