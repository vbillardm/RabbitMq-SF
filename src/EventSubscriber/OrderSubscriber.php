<?php

namespace App\EventSubscriber;

use App\Event\OrderConfirmedEvent;
use Swarrot\Broker\Message;
use Swarrot\SwarrotBundle\Broker\Publisher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderSubscriber implements EventSubscriberInterface
{

    private $swarrotPublisher;

    public function __construct(Publisher $publisher)
    {
        $this->swarrotPublisher = $publisher;
    }

    public function onOrderConfirmed($event)
    {
        /*** @var $event OrderConfirmedEvent */
        $message = new Message($event->getOrder()->getId());
        $this->swarrotPublisher->publish('order_complete_publisher', $message);

    }

    public static function getSubscribedEvents()
    {
        return [
           'order.confirmed' => 'onOrderConfirmed',
        ];
    }
}
