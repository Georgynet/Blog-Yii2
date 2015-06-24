<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 24.06.15
 * Time: 18:01
 */

/** @var $tag common\models\Tags */
/** @var $posts yii\db\ActiveQuery */
/** @var $categories yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = $tag->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-8 post-index">

    <h1>Тэг: <?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($posts->all() as $postTag) {
        echo $this->render('//post/shortView', [
            'model' => $postTag->getPost()->one()
        ]);
    }
    ?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1>Категории</h1>
    <ul>
        <?php
        foreach ($categories->models as $tagItem) {
            echo $this->render('//category/shortViewCategory', [
                'model' => $tagItem
            ]);
        }
        ?>
    </ul>
</div>