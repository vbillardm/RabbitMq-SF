<?php

namespace App\Controller;


use App\Document\Order;
use App\Event\OrderConfirmedEvent;
use App\EventSubscriber\OrderSubscriber;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends controller
{

    /**
     * @Rest\Get("test_order", name="test_order_mongo")
     */
    public function mongoTest()
    {
        $order = new Order();
        $order->setLastname("test-mongo");
        $order->setStatus(Order::STATUS["pending"]);
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($order);
        $dm->flush();

        return new JsonResponse(array('Status' => 'created'), 201);
    }

    /**
     * @REST\Post("order/{id}/confirmed")
     * @ParamConverter("order", class="App:Order")
     * @param Order $order
     * @param EventDispatcherInterface $dispatcher
     * @param OrderSubscriber $orderSubscriber
     * @param OrderConfirmedEvent $confirmedEvent
     * @return JsonResponse
     */
    public function confirmOrder(Order $order, EventDispatcherInterface $dispatcher)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();

        /** $order Order **/
        $order->setStatus(Order::STATUS["confirmed"]);
        $dm->persist($order);
        $dm->flush();

        $event = new OrderConfirmedEvent($order);
        $dispatcher->dispatch(OrderConfirmedEvent::NAME, $event);

        return new JsonResponse(array('Order' => 'Confirmed'), 200);
    }
}