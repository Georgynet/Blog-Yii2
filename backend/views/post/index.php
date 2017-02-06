<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'anons:ntext',
            [
                'label' => Yii::t('backend', 'Category'),
                'value' => 'category.title'
            ],
            [
                'label' => Yii::t('backend', 'Author'),
                'value' => 'author.username',
            ],
            'publish_status',
            'publish_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

</div>
