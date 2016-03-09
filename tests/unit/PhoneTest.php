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
        Artisan::call('migrate');
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
        Artisan::call('migrate:reset');
        $this->phone = null;
        $this->user = null;
    }

    public function testCanCreateAPhone()
    {
        $this->phone->number = $this->faker->numberBetween(1000000000,
            9999999999);
        $this->user->phones()->save($this->phone);
    }

    public function testCannotMassAssignUserID()
    {
        $this->phone->update(array(
            'number' => $this->faker->randomNumber,
            'user_id' => $this->user->id,
        ));
        $this->setExpectedException('Illuminate\Database\QueryException');
        $this->phone->save();
    }

    public function testPhoneMustHaveuser()
    {
        $this->phone->number = $this->faker->randomNumber;
        $this->setExpectedException('Illuminate\Database\QueryException');
        $this->phone->save();
        $this->user->phones()->save($this->phone);
    }
}