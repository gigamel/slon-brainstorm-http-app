<?php

declare(strict_types=1);

use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference\ParameterReference;
use Slon\Renderer\RendererComposite;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->setParameter('views.dir', __DIR__ . '/../../view');
    
    $registry->addMeta(
        (new MetaInstance(RendererComposite::class, 'renderer'))
            ->addArgument('viewsDir', new ParameterReference('views.dir')),
    );
};
