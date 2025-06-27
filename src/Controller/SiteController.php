<?php

declare(strict_types=1);

namespace App\Controller;

use App\Renderer\TplRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;

final class SiteController
{
    public function __construct(private readonly TplRenderer $renderer) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(
            $this->renderer->render('home.tpl'),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
