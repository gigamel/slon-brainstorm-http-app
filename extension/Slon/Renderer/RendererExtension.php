<?php

declare(strict_types=1);

namespace Extension\Slon\Renderer;

use Extension\Slon\Renderer\Extension\Blocks;
use Extension\Slon\Renderer\Extension\Pagination;
use Extension\Slon\Renderer\Extension\Route;
use Slon\Container\Contract\RegistryInterface;
use Slon\Renderer\Contract\RendererCompositeInterface;
use Slon\Renderer\PhpRenderer;
use Slon\Renderer\QuotesExtension;

final class RendererExtension
{
    public function extends(
        RegistryInterface $registry,
        array $configs = [],
    ): void {
        
        if (!$registry->has('renderer')) {
            return;
        }

        $renderer = $registry->get('renderer');
        if (!$renderer instanceof RendererCompositeInterface) {
            return;
        }

        $phpRenderer = new PhpRenderer();
        $phpRenderer->addExtension(new QuotesExtension());
        $phpRenderer->addExtension(
            new Pagination($registry->getOption('views.dir')),
        );

        $phpRenderer->addExtension(
            new Blocks($registry->getOption('views.dir')),
        );

        $renderer->addRenderer($phpRenderer);

        if ($registry->has('routes')) {
            $phpRenderer->addExtension(
                new Route($registry->get('routes')),
            );
        }
        
    }
}
