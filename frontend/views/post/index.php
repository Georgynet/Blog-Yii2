<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $posts yii\data\ActiveDataProvider */
/* @var $categories yii\data\ActiveDataProvider */
/* @var $post common\models\Post */
?>

<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($posts->models as $post) {
        echo $this->render('shortView', [
            'model' => $post
        ]);
    }
    ?>

    <div>
        <?= LinkPager::widget([
            'pagination' => $posts->getPagination()
        ]) ?>
    </div>
</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1><?= Yii::t('frontend', 'Categories') ?></h1>
    <ul>
    <?php
    foreach ($categories->models as $category) {
        echo $this->render('//category/shortViewCategory', [
            'model' => $category
        ]);
    }
    ?>
    </ul>
</div>
