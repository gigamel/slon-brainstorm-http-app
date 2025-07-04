<?php

declare(strict_types=1);

namespace App;

use App\Container\Container;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Kernel\AbstractKernel;
use Slon\Http\Kernel\Configuration\ArrayProvider;
use Slon\Http\Kernel\Import\ClosureImporter;
use Slon\Http\Protocol\Factory\ServerRequestFactory;
use Slon\Http\Router\Contract\RoutesCollectionInterface;

final class HttpKernel extends AbstractKernel
{
    private ?ContainerInterface $container = null;
    
    private readonly string $pwd;

    public function __construct(string $pwd)
    {
        parent::__construct();
        $this->pwd = rtrim($pwd, '/');
    }
    
    protected function getContainer(): ContainerInterface
    {
        if ($this->container) {
            return $this->container;
        }
        
        $this->container = new Container();
        
        $this->import(
            $this->pwd('config/new/*.php'),
            $this->pwd('config/*.php'),
        )->withArgs($this->container);
        
        $this->import(
            $this->pwd('routes/*.php'),
        )->withArgs($this->container->get(RoutesCollectionInterface::class));
        
        $this->loadExtensions();
        
        return $this->container;
    }
    
    protected function getServerRequest(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }
    
    private function import(string ...$patterns): ClosureImporter
    {
        return new ClosureImporter(...$patterns);
    }
    
    private function pwd(?string $path = null): string
    {
        return $this->pwd . ($path ? '/' . $path : '');
    }
    
    private function loadExtensions(): void
    {
        $extensions = (new ArrayProvider(
            $this->pwd('extension/extensions.php'),
        ))->getArray();
        
        foreach ($extensions as $extension => $configs) {
            (new $extension())->extends($this->container, $configs);
        }
    }
}
