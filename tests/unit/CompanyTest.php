<?php

use Faker\Factory;

class CompanyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $faker;
    protected $new_company;
    protected $complete_company;

    protected function _before()
    {
        Artisan::call('migrate');
        $this->faker = Factory::create();
        $this->new_company = new \App\Company();
        $this->complete_company = App\Company::create(array(
            'name' => $this->faker->company,
            'web_based' => true,
            'url' => $this->faker->url,
        ));
    }

    protected function _after()
    {
        $this->new_company = null;
        App\Company::destroy($this->complete_company->id);
        Artisan::call('migrate:reset');
    }

    public function testCanCreateACompany()
    {
        $company = \App\Company::create(array(
            'name' => $this->faker->company,
            'web_based' => true,
            'url' => $this->faker->url,
        ));
        $this->assertEquals('App\Company', get_class($company));
    }

    public function testCompanyValidation()
    {
        $this->assertFalse($this->new_company->validate(array(
            'name' => $this->faker->company,
            'web_based' => true,
        )));
        $this->assertFalse($this->new_company->validate(array(
            'web_based' => true,
            'url' => $this->faker->url,
        )));
        $this->assertTrue($this->new_company->validate(array(
            'name' => $this->faker->company,
            'web_based' => true,
            'url' => $this->faker->url,
        )));
    }

    public function testCompanyCanHaveNoUsers()
    {
        $this->assertCount(0, $this->complete_company->users);
    }

    public function testCompanyCanHaveMultipleUsers()
    {
        $users = array(
            new App\User(array(
                'name' => $this->faker->firstName,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            )),
            new App\User(array(
                'name' => $this->faker->firstName,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            )),
        );
        $this->complete_company->users()->saveMany($users);
        $this->assertGreaterThan(0, count($this->complete_company->users));
    }
}