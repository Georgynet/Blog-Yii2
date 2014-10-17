<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 2:14
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var $category \common\models\Category текущая категория */
/** @var $categories \yii\data\ActiveDataProvider список категорий */
/** @var $posts \yii\data\ActiveDataProvider список категорий */

$this->title = 'Категория ' . $category->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
foreach ($posts->models as $post) {
    echo $this->render('//post/shortView', [
        'model' => $post
    ]);
}
?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1>Категории</h1>
    <ul>
    <?php
    foreach ($categories->models as $category) {
        echo $this->render('shortViewCategory', [
            'model' => $category
        ]);
    }
    ?>
    </ul>
</div>