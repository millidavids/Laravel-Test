<?php

use Faker\Factory;

class UserTest extends \Codeception\TestCase\Test
{

    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $new_user;
    protected $complete_user;


    protected function _before()
    {
        Artisan::call('migrate');
        $this->faker = Factory::create();
        $this->new_user = new \App\User();
        $this->complete_user = App\User::create(array(
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ));
    }

    protected function _after()
    {
        $this->new_user = null;
        App\User::destroy($this->complete_user->id);
        Artisan::call('migrate:reset');
    }

    public function testCanCreateAUser()
    {

        $user = \App\User::create(array(
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ));
        $this->assertEquals('App\User', get_class($user));
    }

    public function testUserValidation()
    {
        $this->assertFalse($this->new_user->validate(array(
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        )));
        $this->assertFalse($this->new_user->validate(array(
            'name' => $this->faker->firstName,
            'password' => $this->faker->password,
        )));
        $this->assertFalse($this->new_user->validate(array(
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
        )));
        $this->assertTrue($this->new_user->validate(array(
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        )));
        $this->assertFalse($this->new_user->validate(array(
            'name' => $this->faker->firstName,
            'email' => 'blah.com',
            'password' => $this->faker->password,
        )));
        $this->assertTrue($this->new_user->validate(array(
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        )));
    }

    public function testUserCanHaveNoPhones()
    {
        $this->assertCount(0, $this->complete_user->phones);
    }

    public function testUserCanHaveOnePhone()
    {
        $phone = new App\Phone(array('number' => $this->faker->randomNumber));
        $this->complete_user->phones()->save($phone);
        $this->assertCount(1, $this->complete_user->phones);
    }

    public function testUserCanHaveMultiplePhones()
    {
        $phones = array(
            new App\Phone(array(
                'number' => $this->faker->randomNumber,
            )),
            new App\Phone(array(
                'number' => $this->faker->randomNumber,
            )),
        );
        $this->complete_user->phones()->saveMany($phones);
        $this->assertGreaterThan(1, count($this->complete_user->phones));
    }
}
