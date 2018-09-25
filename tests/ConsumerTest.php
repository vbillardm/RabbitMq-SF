<?php

namespace App\Tests;

use App\Processor\orderComplete;
use PHPUnit\Framework\TestCase;
use Swarrot\Broker\Message;

class ConsumerTest extends TestCase
{

    public function testConstructorWithoutDependancies()
    {
        $this->expectException(\TypeError::class);
        new orderComplete(new \stdClass(), new \stdClass());
    }


    public function testSendMail()
    {
        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $templating = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $consumer = new orderComplete($swift, $templating);

        $message = new Message("test");
        $email = $consumer->process($message, array());

dump($consumer->process($message, array()));

        $this->assertEquals(1, $email);

    }
}
