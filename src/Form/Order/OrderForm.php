<?php

declare(strict_types=1);

namespace App\Form\Order;

use App\Form\Form;
use Psr\Http\Message\ServerRequestInterface;

final class OrderForm extends Form
{
    public function __construct(private Order $order) {}
    
    public function getOrder(): Order
    {
        return $this->order;
    }
    
    protected function isValid(ServerRequestInterface $request): bool
    {
        return true;
    }
}
