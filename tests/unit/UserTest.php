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
    protected $new_user;
    protected $complete_user;


    protected function _before()
    {
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
        $this->specify('user requires name, email, and password', function () {
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
        });

        $this->specify('user email must have an @ symbol', function () {
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
        });
    }

    public function testPhoneRelationship()
    {
        $this->specify('user can have no phones', function () {
            $this->assertCount(0, $this->complete_user->phones);
        });

        $this->specify('user can have one phone', function () {
            $phone = new App\Phone(array('number' => $this->faker->randomNumber));
            $this->complete_user->phones()->save($phone);
            $this->assertCount(1, $this->complete_user->phones);
        });

        $this->specify('user can have multiple phones', function () {
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
        });
    }
}
