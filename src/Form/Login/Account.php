<?php

declare(strict_types=1);

namespace App\Form\Login;

final class Account
{
    public function __construct(
        private string $email = '',
        
        private string $password = '',
    ) {}
    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
}
