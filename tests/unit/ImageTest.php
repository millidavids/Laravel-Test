<?php

use Faker\Factory;

class ImageTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $image;
    protected $user;
    protected $company;

    protected function _before()
    {
        Artisan::call('migrate');
        $this->faker = Factory::create();
        $this->image = new App\Image();
    }

    protected function _after()
    {
        Artisan::call('migrate:reset');
    }

    // tests
    public function testMe()
    {

    }
}