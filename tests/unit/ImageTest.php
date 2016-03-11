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
        $this->user = factory(\App\User::class)->create();
        $this->company = factory(\App\Company::class, 'web_company')->create();
    }

    protected function _after()
    {
        \App\User::destroy($this->user->id);
        \App\Company::destroy($this->company->id);
        Artisan::call('migrate:reset');
    }

    public function testCannotCreateAnImageWithoutAnImageable()
    {
        $this->setExpectedException('Illuminate\Database\QueryException');
        \App\Image::create(array(
            'path' => 'path/to/a/thing',
        ));
    }

    public function testCanCreateACompanyImage()
    {
        $this->image->path = 'path/to/another/thing';
        $this->company->images()->save($this->image);
        $this->assertEquals('App\Company', $this->image->imageable_type);
    }

    public function testCanCreateAUserImage()
    {
        $this->image->path = 'path/to/yet/another/thing';
        $this->user->images()->save($this->image);
        $this->assertEquals('App\User', $this->image->imageable_type);
    }
}