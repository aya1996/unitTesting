<?php

namespace tests\Unit;

use App\Models\User;

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    /** @test */
    public function that_we_can_get_first_name()
    {

        $this->user->setFirstName('aya');
        $this->assertEquals($this->user->getFirstName(), 'aya');
    }
    /** @test */
    public function that_can_get_last_name()
    {
        $this->user->setLastName('mohamed');
        $this->assertEquals($this->user->getLastName(), 'mohamed');
    }
    /** @test */
    public function full_name_is_returned()
    {

        $this->user->setFirstName('aya');
        $this->user->setLastName('mohamed');
        $this->assertEquals($this->user->getFullName(), 'aya mohamed');
    }
    /** @test */
    public function first_and_last_name_are_trimmed()
    {
        $this->user->setFirstName(" aya ");
        $this->user->setLastName(" mohamed ");
        $this->assertEquals($this->user->getFirstName(), 'aya');
        $this->assertEquals($this->user->getLastName(), 'mohamed');
    }
    /** @test */
    public function email_address_can_be_set()
    {
        $this->user->setEmail('aya@gmail.com');
        $this->assertEquals($this->user->getEmail(), 'aya@gmail.com');
    }
    /** @test */
    public function email_variables_contains_correct_values()
    {

        $this->user->setFirstName('aya');
        $this->user->setLastName('mohamed');
        $this->user->setEmail('aya@gmail.com');

        $emailVariables = $this->user->getEmailVariables();


        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals('aya mohamed', $emailVariables['full_name']);
        $this->assertEquals('aya@gmail.com', $emailVariables['email']);
    }
}
