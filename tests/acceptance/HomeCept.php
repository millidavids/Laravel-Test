<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('Laravel');
$I->click('Home');
$I->see('Login');
