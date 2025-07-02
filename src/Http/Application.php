<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Kernel\Contract\ApplicationInterface;
use Slon\Http\Kernel\Exception\HttpException;
use Slon\Http\Router\Contract\RouterInterface;
use Slon\Http\Router\Exception\RouteNotFoundException;

final class Application implements ApplicationInterface
{
    public function __construct(
        private ControllerResolver $resolver,
        private RouterInterface $router,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $routeShard = $this->router->handleRequest($request);
        } catch (RouteNotFoundException $e) {
            throw new HttpException('Controller not found', 404, $e);
        }
        
        foreach ($routeShard->getSegments() as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }
        
        return $this->resolver->resolve($routeShard->getHandler())($request);
    }
}
