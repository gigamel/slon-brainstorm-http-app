<?php

declare(strict_types=1);

namespace App\Renderer;

use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Renderer\Contract\ExtensionInterface;

final readonly class RouteExtension implements ExtensionInterface
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
