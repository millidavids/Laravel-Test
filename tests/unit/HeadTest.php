<?php

use Faker\Factory;

class HeadTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $head;
    protected $user;

    protected function _before()
    {
        Artisan::call('migrate');
        $this->faker = Factory::create();
        $this->head = new \App\Head();
        $this->user = \App\User::create(array(
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ));
    }

    protected function _after()
    {
        Artisan::call('migrate:reset');
        $this->head = null;
        $this->user = null;
    }

    public function testCanCreateAHead()
    {
        $this->user->head()->save($this->head);
    }

    public function testCannotMassAssignUserID()
    {
        $this->head->update(array(
            'user_id' => $this->user->id,
        ));
        $this->setExpectedException('Illuminate\Database\QueryException');
        $this->head->save();
    }

    public function testPhoneMustHaveAUser()
    {
        $this->setExpectedException('Illuminate\Database\QueryException');
        $this->head->save();
        $this->user->head()->save($this->head);
    }
}