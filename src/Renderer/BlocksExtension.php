<?php

declare(strict_types=1);

namespace App\Renderer;

use Slon\Renderer\Contract\ExtensionInterface;
use Slon\Renderer\Contract\RendererInterface;

final class BlocksExtension implements ExtensionInterface
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
