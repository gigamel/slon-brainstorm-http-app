<?php

declare(strict_types=1);

namespace App\Form\Login;

use App\Form\AbstractForm;
use Psr\Http\Message\ServerRequestInterface;

use function str_contains;

final class LoginForm extends AbstractForm
{
    public function __construct(private Account $account) {}
    
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
            $this->account->setEmail($formParams['email']);
        }
        
        if ($formParams['password'] ?? null) {
            $this->account->setPassword($formParams['password']);
        }
        
        return $this;
    }
    
    public function isValid(): bool
    {
        $isValid = true;
        
        if (!\filter_var($this->account->getEmail(), \FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $this->errors['email'] = 'Invalid E-mail';
        }
        
        if (empty(trim($this->account->getPassword()))) {
            $isValid = false;
            $this->errors['password'] = 'Invalid Password';
        }
        
        return $isValid;
    }
    
    public function getAccount(): Account
    {
        return $this->account;
    }
}
