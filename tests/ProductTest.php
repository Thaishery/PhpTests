<?php

namespace App\Tests\Entity;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase{
    public function testProductEntity(){
        $product = new Product();
        $product->setName('iPhone');
        $product->setPrice(150);

        $this->assertEquals("iPhone", $product->getName());
        $this->assertEquals(150, $product->getPrice());
        
    }
}