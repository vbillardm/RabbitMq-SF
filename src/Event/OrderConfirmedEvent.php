<?php


namespace App\Event;


use App\Document\Order;
use Symfony\Component\EventDispatcher\Event;

class OrderConfirmedEvent extends Event
{

    const NAME = 'order.confirmed';

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}