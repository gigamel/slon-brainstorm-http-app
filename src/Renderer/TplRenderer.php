<?php

declare(strict_types=1);

namespace App\Renderer;

use RuntimeException;

use function sprintf;

final class TplRenderer
{
    private readonly string $pwd;
    
    public function __construct(string $pwd)
    {
        $this->pwd = rtrim($pwd, '/');
    }
    
    public function withNamespace(string $namespace): self
    {
        return new self($this->pwd . '/' . $namespace);
    }
    
    public function render(string $view, array $vars = []): string
    {
        $view = $this->pwd . '/' . $view;
        if (!file_exists($view)) {
            throw new RuntimeException(sprintf(
                'View "%s" does not exists',
                $view,
            ));
        }
        
        extract($vars);
        unset($vars);
        
        try {
            \ob_start();
            require $view;
            $contents = \ob_get_contents();
        } finally {
            \ob_end_clean();
        }
        
        return $contents;
    }
}
