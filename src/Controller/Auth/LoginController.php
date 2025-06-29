<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Form\Login\Account;
use App\Form\Login\LoginForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Renderer\Contract\RendererCompositeInterface;

final class LoginController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = (new LoginForm(new Account()))->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new Response(
                '',
                302,
                ['Location' => '/'],
            );
        }
        
        return new Response(
            $this->renderer->render('auth/login.php', ['form' => $form]),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
