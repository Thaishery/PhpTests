<?php

namespace App\Tests\Entity;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase{
    public function testOrderEntity(){
        $order = new Order();
        $user = new User();

        $order->setNumber(10);
        $order->setTotalPrice(1500);
        $order->setUserId($user);

        $this->assertEquals(10, $order->getNumber());
        $this->assertEquals(1500,$order->getTotalPrice());
        $this->assertEquals($user,$order->getUserId());
    }
}