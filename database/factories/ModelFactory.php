<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\User::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Phone::class,
    function (\Faker\Generator $faker) use ($factory) {
        return [
            'number' => $faker->numberBetween(1000000000, 9999999999),
            'user_id' => factory(\App\User::class)->create()->id,
        ];
    });

$factory->defineAs(\App\Company::class, 'web_company',
    function (\Faker\Generator $faker) {
        return [
            'name' => $faker->company,
            'web_based' => true,
            'url' => $faker->url,
        ];
    });

$factory->defineAs(\App\Company::class, 'non_web_company',
    function (\Faker\Generator $faker) {
        return [
            'name' => $faker->company,
            'web_based' => true,
            'url' => $faker->url,
        ];
    });

$factory->define(\App\Head::class,
    function (\Faker\Generator $faker) use ($factory) {
        return [
            'user_id' => factory(\App\User::class)->create()->id,
        ];
    });

$factory->defineAs(\App\Image::class, 'company_image',
    function (\Faker\Generator $faker) use ($factory) {
        return [
            'path' => storage_path().'/app/batman_symbol.png',
            'imageable_type' => 'App\Company',
            'imageable_id' => factory(\App\Company::class)->create()->id,
        ];
    });

$factory->defineAs(\App\Image::class, 'user_image',
    function (\Faker\Generator $faker) use ($factory) {
        return [
            'path' => storage_path().'/app/batman_symbol.png',
            'imageable_type' => 'App\User',
            'imageable_id' => factory(\App\User::class)->create()->id,
        ];
    });
