<?php

declare(strict_types=1);

namespace App\Form\Contact;

use App\Form\AbstractForm;
use Psr\Http\Message\ServerRequestInterface;

use function str_contains;

final class ContactForm extends AbstractForm
{
    public function __construct(private Contact $contact) {}
    
    public function handleRequest(
        ServerRequestInterface $request,
    ): self {
        $contentType = $request->getHeaderLine('Content-Type');
        
        if (
            str_contains($contentType, 'application/x-www-form-urlencoded')
            && 'POST' === $request->getMethod()
        ) {
            $this->isSubmitted = true;
        }
        
        if (!$this->isSubmitted) {
            return $this;
        }
        
        $formParams = $request->getParsedBody();
        
        if ($formParams['email'] ?? null) {
            $this->contact->setEmail($formParams['email']);
        }
        
        if ($formParams['message'] ?? null) {
            $this->contact->setMessage($formParams['message']);
        }
        
        return $this;
    }
    
    public function isValid(): bool
    {
        $isValid = true;
        
        if (!\filter_var($this->contact->getEmail(), \FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $this->errors['email'] = 'Invalid E-mail';
        }
        
        if (empty(trim($this->contact->getMessage()))) {
            $isValid = false;
            $this->errors['message'] = 'Invalid Message';
        }
        
        return $isValid;
    }
    
    public function getContact(): Contact
    {
        return $this->contact;
    }
}
