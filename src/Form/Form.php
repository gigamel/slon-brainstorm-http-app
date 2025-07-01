<?php

declare(strict_types=1);

namespace App\Form;

use Psr\Http\Message\ServerRequestInterface;

abstract class Form
{
    protected string $method = 'POST';
    
    protected string $action = '';
    
    protected ?string $button = null;
    
    protected bool $autocomplete = false;
    
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }
    
    public function getMethod(): string
    {
        return $this->method;
    }
    
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }
    
    public function getAction(): string
    {
        return $this->action;
    }
    
    public function setButton(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    public function getButton(): ?string
    {
        return $this->button;
    }
    
    public function setAutoComplete(bool $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function getAutoComplete(): string
    {
        return $this->autocomplete ? 'on' : 'off';
    }
    
    public function isSubmitted(ServerRequestInterface $request): bool
    {
        if ($this->getMethod() !== $request->getMethod()) {
            return false;
        }
        
        return $this->isValid($request);
    }
    
    abstract protected function isValid(ServerRequestInterface $request): bool;
}
