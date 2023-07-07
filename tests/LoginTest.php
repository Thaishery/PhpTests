<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
  private $client;

  protected function setUp(): void
  {
      parent::setUp();
      $this->client = static::createClient();
  }
  public function testLoginFail(): void {
    // $client = static::createClient();
    $crawler = $this->client->request('GET', '/login');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('login')->form([
      '_username' => 'john@doe.fr',
      '_password' => 'fakepassword'
    ]);

    $this->client->submit($form);
    $response = $this->client->getResponse();
    $this->assertTrue($response->isRedirect());
    $this->assertResponseStatusCodeSame(302);
    $redirectUrl = $response->headers->get('Location');
    $this->assertStringEndsWith('/login', $redirectUrl);
    $this->client->followRedirect();
    $this->assertSelectorTextContains('div', 'Invalid credentials.');
  }

  public function testLoginSuccess(): void {
    // $client = static::createClient();
    $crawler = $this->client->request('GET', '/login');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('login')->form([
      '_username' => 'guillaume@mail.com',
      '_password' => 'test_pass'
  ]);

    $this->client->submit($form);

    $response = $this->client->getResponse();
    $this->assertTrue($response->isRedirect());
    $this->assertResponseStatusCodeSame(302);
    $redirectUrl = $response->headers->get('Location');
    $this->assertStringEndsWith('/', $redirectUrl);

    // $this->assertResponseRedirects('http://localhost/');

    $this->client->followRedirect();
    $this->assertSelectorTextContains('h1', 'Vous êtes connecté');
  }
  protected function tearDown(): void
  {
    parent::tearDown();
    unset($this->client);
  }
}
