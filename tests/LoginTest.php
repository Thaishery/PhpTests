<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
  public function testLoginFail(): void {
    $client = static::createClient();
    $crawler = $client->request('GET', '/login');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('login')->form([
      '_username' => 'john@doe.fr',
      '_password' => 'fakepassword'
  ]);

    $client->submit($form);

    $this->assertResponseRedirects('http://localhost/login');
    $client->followRedirect();
    $this->assertSelectorTextContains('div', 'Invalid credentials.');
  }

  public function testLoginSuccess(): void {
    $client = static::createClient();
    $crawler = $client->request('GET', '/login');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('login')->form([
      '_username' => 'guillaume@mail.com',
      '_password' => 'test_pass'
  ]);

    $client->submit($form);

    $this->assertResponseRedirects('http://localhost/');
    $client->followRedirect();
    $this->assertSelectorTextContains('h1', 'Vous êtes connecté');
  }
}
