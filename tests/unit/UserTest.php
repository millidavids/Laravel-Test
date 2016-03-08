<?php

use Faker\Factory;

class UserTest extends \Codeception\TestCase\Test
{
    use Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $mock;
    protected $user;

    public function testCanCreateAUser()
    {

        $user = \App\User::create(array(
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ));
        $this->assertEquals('App\User', get_class($user));
    }

    public function testUserValidation()
    {
        $this->specify('user requires name, email, and password', function () {
            $this->assertFalse($this->user->validate(array(
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            )));
            $this->assertFalse($this->user->validate(array(
                'name' => $this->faker->name,
                'password' => $this->faker->password,
            )));
            $this->assertFalse($this->user->validate(array(
                'name' => $this->faker->name,
                'email' => $this->faker->email,
            )));
            $this->assertTrue($this->user->validate(array(
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            )));
        });

        $this->specify('user email must have an @ symbol', function () {
            $this->assertFalse($this->user->validate(array(
                'name' => $this->faker->name,
                'email' => 'blah.com',
                'password' => $this->faker->password,
            )));
            $this->assertTrue($this->user->validate(array(
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            )));
        });
    }

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->user = new \App\User();
    }

    protected function _after()
    {
        $this->user = null;
    }
}