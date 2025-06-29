<?php

declare(strict_types=1);

namespace App\Form;

use Psr\Http\Message\ServerRequestInterface;

use function array_key_exists;

abstract class AbstractForm
{
    protected bool $isSubmitted = false;
    
    protected array $errors = [];

    public function isSubmitted(): bool
    {
        return $this->isSubmitted;
    }
    
    public function hasError(string $name): bool
    {
        return array_key_exists($name, $this->errors);
    }
    
    public function getError(string $name): string
    {
        return $this->errors[$name] ?? '';
    }
    
    abstract public function isValid(): bool;

    abstract public function handleRequest(
        ServerRequestInterface $request,
    ): self;
}
