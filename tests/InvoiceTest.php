<?php

namespace App\Tests\Service;

use App\Service\Invoice;
use App\Service\EmailService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceTest extends KernelTestCase{
  public function testInvoice(){
    $mailer = $this->createMock(EmailService::class);
    $mailer->expects($this->once())->method('send')->willReturn(true);
    $invoice = new Invoice($mailer);
    $result = $invoice->process();
    $this->assertTrue($result);
  }
}