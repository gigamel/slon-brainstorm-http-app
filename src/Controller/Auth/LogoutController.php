<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Renderer\Contract\RendererCompositeInterface;

final class LogoutController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(
            $this->renderer->render('auth/logout.php'),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
