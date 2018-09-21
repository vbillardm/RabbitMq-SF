<?php

namespace App\Processor;

use Swarrot\Broker\Message;
use Swarrot\Processor\ProcessorInterface;

class orderComplete implements ProcessorInterface
{
    public function process(Message $message, array $options)
    {
        dump($message, "in consumer");die;
    }
}