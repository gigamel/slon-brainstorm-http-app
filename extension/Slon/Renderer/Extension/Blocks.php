<?php

declare(strict_types=1);

namespace Extension\Slon\Renderer\Extension;

use Slon\Renderer\Contract\ExtensionInterface;
use Slon\Renderer\Contract\RendererInterface;

final class Blocks implements ExtensionInterface
{
    public function __construct(
        private readonly string $viewDirs,
    ) {}
    
    public function getName(): string
    {
        return 'block';
    }
        
    public function __invoke(
        RendererInterface $renderer,
        string $view,
        array $vars = [],
    ): string {
        return $renderer->render($this->viewDirs . '/' . $view, $vars);
    }
}
