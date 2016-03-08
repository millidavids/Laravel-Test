<?php

use Faker\Factory;

class PhoneTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $phone;
    protected $user;

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->phone = new \App\Phone();
        $this->user = \App\User::create(array(
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ));
    }

    protected function _after()
    {
        $this->phone = null;
        $this->user = null;
    }

    public function testCanCreateAPhone()
    {
        $this->phone->number = $this->faker->numberBetween(1000000000,
            9999999999);
        $this->user->phones()->save($this->phone);
    }
}