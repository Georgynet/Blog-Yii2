<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 1:39
 */

/* @var $model common\models\Category */
?>
<li><?= \yii\helpers\Html::a($model->title, ['category/view', 'id' => $model->id])?></li>