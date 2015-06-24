<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 24.06.15
 * Time: 18:01
 */

use yii\helpers\Html;

$this->title = $category->title;
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
        foreach ($categories->models as $category) {
            echo $this->render('//category/shortViewCategory', [
                'model' => $category
            ]);
        }
        ?>
    </ul>
</div>