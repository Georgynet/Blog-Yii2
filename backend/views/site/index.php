<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <h3>Блог</h3>
        <ul class="nav nav-pills">
            <li><a href="<?= Url::toRoute('post/index'); ?>">Посты</a></li>
            <li><a href="<?= Url::toRoute('category/index'); ?>">Категории</a></li>
            <li><a href="<?= Url::toRoute('tags/index'); ?>">Тэги</a></li>
            <li><a href="<?= Url::toRoute('comment/index'); ?>">Комментарии</a></li>
            <li><a href="<?= Url::toRoute('user/index'); ?>">Пользователи</a></li>
        </ul>

    </div>
</div>
