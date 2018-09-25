<?php
/**
 * Created by PhpStorm.
 * User: VBM
 * Date: 25/09/2018
 * Time: 15:42
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class OrderControllerTest extends  WebTestCase
{

    public function testOrderConfirmed()
    {
        $client = static::createClient();

        $client->request('POST', '/order/5ba49cf192f154acf15a2641/confirmed');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}