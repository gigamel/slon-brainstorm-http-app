<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slon\Http\Protocol\Response;

final class AuthMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
    ): ResponseInterface {
        if (!\str_starts_with($request->getUri()->getPath(), '/admin/')) {
            return $handler->handle($request);
        }
        
        $user = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $pass = $request->getServerParams()['PHP_AUTH_PW'] ?? null;
        
        if ($user === 'admin' && $pass === 'abc') {
            return $handler->handle($request);
        }
        
        return new Response(
            '',
            401,
            [
                'WWW-Authenticate' => 'Basic realm="Admin panel"',
            ],
        );
    }
}
