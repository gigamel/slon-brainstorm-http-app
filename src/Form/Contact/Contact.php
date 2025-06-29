<?php

declare(strict_types=1);

namespace App\Form\Contact;

final class Contact
{
    public function __construct(
        private string $email = '',
        
        private string $message = '',
    ) {}
    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    
    public function getMessage(): string
    {
        return $this->message;
    }
}
