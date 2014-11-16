<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tags */

$this->title = 'Добавить тэг';
$this->params['breadcrumbs'][] = ['label' => 'Тэги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
