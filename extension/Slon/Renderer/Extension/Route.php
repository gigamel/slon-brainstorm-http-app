<?php

declare(strict_types=1);

namespace Extension\Slon\Renderer\Extension;

use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Renderer\Contract\ExtensionInterface;

final readonly class Route implements ExtensionInterface
{
    public function __construct(
        private RoutesCollectionInterface $routes,
    ) {}

    public function getName(): string
    {
        return 'route';
    }
    
    public function __invoke(string $name, array $vars = []): string
    {
        return $this->routes->get($name)->generate($vars);
    }
}
