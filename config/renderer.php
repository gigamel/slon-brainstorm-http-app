<?php

declare(strict_types=1);

use App\Renderer\TplRenderer;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference\ParameterReference;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->setParameter('views.dir', __DIR__ . '/../view');
    
    $registry->addMeta(
        (new MetaInstance(TplRenderer::class, 'tpl_renderer'))
            ->addArgument('pwd', new ParameterReference('views.dir')),
    );
    
};
