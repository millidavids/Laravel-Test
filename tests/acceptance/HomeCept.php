<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('visit root and home page and see correct stuff');
$I->amOnPage('/');
$I->see('Laravel');
$I->click('Home');
$I->see('Login');
