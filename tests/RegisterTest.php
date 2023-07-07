<?php

namespace App\Tests\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
  private $entityManager;
  private $client;

  protected function setUp(): void
  {
      parent::setUp();
      $this->client = static::createClient();
      $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);
  }

  public function testRegister(): void {
    $crawler = $this->client->request('GET', '/register');
    $buttonCrawlerNode = $crawler->selectButton('login');
    $form = $crawler->selectButton('Register')->form([
      'registration_form[email]' => 'john@doe.fr',
      'registration_form[plainPassword]' => 'fakepassword',
      'registration_form[firstName]' => 'john',
      'registration_form[lastName]' => 'doe',
  ]);

    $this->client->submit($form);

    $this->assertResponseRedirects('/login');
    $this->client->followRedirect();
    $this->assertSelectorTextContains('a', 'S\'inscrire');
    $createdUsers = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'john@doe.fr']);
    $this->assertEquals("doe", $createdUsers->getLastname());
    $this->assertEquals("john", $createdUsers->getFirstname());
    $this->assertEquals("john@doe.fr", $createdUsers->getEmail());
    $this->assertEquals("john@doe.fr", $createdUsers->getUserIdentifier());
    //? hashé ... forcement .... 
    // $this->assertEquals("fakepassword", $createdUsers->getPassword());
    $this->assertTrue(password_verify("fakepassword",$createdUsers->getPassword()));

  }
  protected function tearDown(): void
  {
    parent::tearDown();
    unset($this->client);
    $createdUsers = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'john@doe.fr']);
    if($createdUsers){
      $this->entityManager->getRepository(User::class)->remove($createdUsers);
      $this->entityManager->flush();
    } 
    unset($this->entityManager);
  }
}
