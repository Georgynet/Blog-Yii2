<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $authors yii\db\ActiveRecord[] */
/* @var $category yii\db\ActiveRecord[] */
/* @var $tags yii\db\ActiveRecord[] */

$this->title = 'Создание поста';
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'tags' => $tags,
        'authors' => $authors
    ]) ?>

</div>
