<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model common\models\Post */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($dataProvider->models as $model) {
        echo $this->render('shortView', [
            'model' => $model
        ]);
    }
    ?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1>Категории</h1>
</div>