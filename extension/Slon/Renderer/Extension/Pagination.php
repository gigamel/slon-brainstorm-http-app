<?php

declare(strict_types=1);

namespace Extension\Slon\Renderer\Extension;

use App\Widget\Paginator;
use Slon\Http\Router\Contract\RouteInterface;
use Slon\Renderer\Contract\ExtensionInterface;
use Slon\Renderer\Contract\RendererInterface;

final class Pagination implements ExtensionInterface
{
    public function __construct(
        private readonly string $viewDirs,
    ) {}
    
    public function getName(): string
    {
        return 'pagination';
    }
        
    public function __invoke(
        RendererInterface $renderer,
        string $view,
        Paginator $paginator,
        RouteInterface $route,
    ): string {
        return $renderer->render(
            $this->viewDirs . '/' . $view,
            [
                'paginator' => $paginator,
                'route' => $route,
            ],
        );
    }
}
