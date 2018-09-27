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

        $message = $this->getMockBuilder(Message::class)
            ->disableOriginalConstructor()
            ->getMock();

        $message->method("getBody")->willReturn("testBody");

        $email = $this->getMockBuilder(\Swift_Message::class)
            ->disableOriginalConstructor()
            ->setConstructorArgs(["Hello Email", "testBody"])
            ->getMock();


        $swift->expects($this->once())
            ->method("send")
            ->with($email)
            ->willReturn(1);

        $consumer = new orderComplete($swift, $templating);
        $response = $consumer->process($message, array());

    }
}
