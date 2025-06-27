<?php

declare(strict_types=1);

namespace App\Renderer;

use RuntimeException;

use function file_get_contents;
use function is_scalar;
use function is_string;
use function sprintf;
use function str_replace;

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
        
        $contents = file_get_contents($view);
        if (false === $contents) {
            throw new RuntimeException(sprintf(
                'The view file "%s" cannot be included',
                $view,
            ));
        }
        
        foreach ($vars as $var => $replace) {
            if (!is_string($var) || !is_scalar($replace)) {
                continue;
            }
            
            $contents = str_replace(
                sprintf('{{ %s }}', $var),
                (string) $replace,
                $contents,
            );
        }
        
        return $contents;
    }
}
