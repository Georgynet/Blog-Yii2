<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 09.07.14
 * Time: 9:26
 */
use yii\helpers\Html;

/* @var $model common\models\Post */
?>

<h1><?= $model->title ?></h1>

<div>
    <?= $model->anons ?>
</div>

<?= Html::a('Читать далее', ['view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>