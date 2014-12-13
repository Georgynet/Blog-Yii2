<?php

use frontend\tests\_pages\BlogPage;

$I = new WebGuy($scenario);
$I->wantTo('ensure that about works');
BlogPage::openBy($I);
$I->see('About', 'h1');
