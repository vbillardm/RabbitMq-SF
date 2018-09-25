<?php

namespace App\Processor;

use Swarrot\Broker\Message;
use Swarrot\Processor\ProcessorInterface;

class orderComplete implements ProcessorInterface
{

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->engine = $templating;
    }

    public function process(Message $message, array $options)
    {
        $email = (new \Swift_Message('Hello Email'))
            ->setFrom('test@gmail.com')
            ->setTo('victorbillardmadrieres@gmail.com')
            ->setBody(
                $this->engine->render(
                    'Order/orderConfirmed.html.twig',
                    array('id' => $message->getBody())
                ),
                'text/html'
            );

        return $this->mailer->send($email);
    }
}