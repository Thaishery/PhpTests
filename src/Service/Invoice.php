<?php
namespace App\Service;

use App\Entity\Order;
use App\Entity\User;
use App\Service\EmailService;

class Invoice
{
  private $mailer; 
  public function __construct($mailer=new EmailService)
  {
    $this->mailer = $mailer;
  }
  // public function process($email = "", $message="" ){
  //   $result = $this->mailer->send($email,$message);
  //   return $result; 
  // }
  public function process(){
    $result = $this->mailer->send();
    return $result; 
  }
}