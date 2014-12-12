<?php

use frontend\tests\_pages\BlogPage;

$I = new TestGuy($scenario);
$I->wantTo('Test blog page');
BlogPage::openBy($I);
$I->see('Посты', '.post-index h1');
$I->see('Категории', '.blog-sidebar h1');