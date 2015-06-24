<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 09.07.14
 * Time: 9:26
 */
use common\models\TagPost;
use yii\helpers\Html;

/* @var $model common\models\Post */
/* @var TagPost $postTag */
?>

<h1><?= $model->title ?></h1>

<div class="meta">
    <p>Автор: <?= $model->author->username ?> Дата публикации: <?= $model->publish_date ?> Категория: <?= Html::a($model->category->title, ['category/view', 'id' => $model->category->id]) ?></p>
</div>

<div class="content">
    <?= $model->anons ?>
</div>

<div class="tags">
    <?php
    $tags = [];
    foreach($model->getTagPost()->all() as $postTag) {
        $tag = $postTag->getTag()->one();
        $tags[] = Html::a($tag->title, ['tag/view', 'id' => $tag->id]);
    } ?>

    Тэги: <?= implode($tags, ', ') ?>
</div>

<?= Html::a('Читать далее', ['post/view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
