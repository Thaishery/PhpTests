<?php

namespace App\Tests\Entity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase{
    public function testUserEntity(){
        $user = new User();
        $user->setLastname('Doe');
        $user->setFirstname('John');
        $user->setEmail("j.doe@mail.com");
        $user->setPassword("123456");
        $user->setRoles(["ROLE_ADMIN"]);

        $this->assertEquals("Doe", $user->getLastname());
        $this->assertEquals("John", $user->getFirstname());
        $this->assertEquals("j.doe@mail.com", $user->getEmail());
        $this->assertEquals("j.doe@mail.com", $user->getUserIdentifier());
        $this->assertEquals("123456", $user->getPassword());
        $this->assertContains("ROLE_ADMIN", $user->getRoles());
    }
}