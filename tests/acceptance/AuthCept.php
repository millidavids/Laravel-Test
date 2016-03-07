<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('be able to register a valid user');
$I->amOnPage('/register');
$I->see('Register');
$I->fillField('name', 'Bruce Wayne');
$I->fillField('email', 'bruce@wayneenterprises.com');
$I->fillField('password', 'batman');
$I->fillField('password_confirmation', 'batman');
$I->click('Register', 'form');
$I->see('Bruce Wayne');
