<?php

namespace App\Tests\Service;

use App\Service\Calculator;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorTest extends KernelTestCase{
  public function testCalculatorGetTotalHT(){
    //? init object : 
    $calculator = new Calculator;
    $product1 = new Product;
    $product2 = new Product;
    
    //? setValue : 
    $product1->setName("iPhone");
    $product1->setPrice(150);
    $product2->setName("banane");
    $product2->setPrice(10);

    
    //? calculate : 
    $totalHT = $calculator->getTotalHT([[$product1,10],[$product2,10]]);


    //?check : 
    //? 10*150 + 10*10 = 1600
    $this->assertEquals(1600, $totalHT);

  }

  public function testCalculatorGetTotalTTC(){
    //? init object : 
    $calculator = new Calculator;
    $product1 = new Product;
    $product2 = new Product;
    
    //? setValue : 
    $product1->setName("iPhone");
    $product1->setPrice(150);
    $product2->setName("banane");
    $product2->setPrice(10);
    $tva = 20;
    
    //? calculate : 
    $totalTTC = $calculator->getTotalTTC([[$product1,10],[$product2,10]],$tva);


    //?check : 
    //? 1600 *0.2 + 1600 = 1920 :
    $this->assertEquals(1920,$totalTTC);
  }
}