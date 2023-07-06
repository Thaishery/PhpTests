<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
  public function testRegister(): void {
    $client = static::createClient();
    $crawler = $client->request('GET', '/register');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('Register')->form([
      'registration_form[email]' => 'john@doe.fr',
      'registration_form[plainPassword]' => 'fakepassword',
      'registration_form[firstName]' => 'john',
      'registration_form[lastName]' => 'doe',
  ]);

    $client->submit($form);

    $this->assertResponseRedirects('/login');
    $client->followRedirect();
    $this->assertSelectorTextContains('a', 'S\'inscrire');
  }
}
