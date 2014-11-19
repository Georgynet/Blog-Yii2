<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */

$this->title = 'Редактировать тэг: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Тэги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
