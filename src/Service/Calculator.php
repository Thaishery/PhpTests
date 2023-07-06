<?php
namespace App\Service;

use App\Entity\Product;


class Calculator
{
  public function getTotalHT($products=[]){
    $result = 0; 
    foreach($products as $product){
      $price = $product[0]->getPrice();
      $total = $price * $product[1];
      $result += $total;
    }
    return $result;
  }
  public function getTotalTTC($products=[],$tva=0){
    $result = 0; 
    $ht = $this->getTotalHT($products);
    $result = ($ht * ($tva/100))+$ht;
    return $result;
  }
}