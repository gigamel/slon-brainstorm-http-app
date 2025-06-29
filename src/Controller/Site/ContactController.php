<?php

declare(strict_types=1);

namespace App\Controller\Site;

use App\Form\Contact\Contact;
use App\Form\Contact\ContactForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Renderer\Contract\RendererCompositeInterface;

final class ContactController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = (new ContactForm(new Contact()))->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            return new Response(
                '',
                302,
                ['Location' => '.'],
            );
        }
        
        return new Response(
            $this->renderer->render(
                'site/contact.php',
                ['form' => $form],
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
