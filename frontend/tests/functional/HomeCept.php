<?php

$I = new TestGuy($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->seeLink('Sllite.ru');
$I->seeLink('Home');
$I->seeLink('Blog');
$I->seeLink('Contact');
$I->seeLink('Login');
$I->seeLink('Signup');
$I->click('About');
$I->see('This is the About page.');
