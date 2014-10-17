<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 09.07.14
 * Time: 9:26
 */

/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $model->title ?></h1>

<div class="meta">
    <p>Автор: <?= $model->author->username ?> Дата публикации: <?= $model->publish_date ?> Категория: <?= $model->category->title ?></p>
</div>

<div>
    <?= $model->content ?>
</div>