<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 09.07.14
 * Time: 9:26
 */
use common\models\Comment;
use common\models\TagPost;

/* @var $model common\models\Post */
/* @var \frontend\models\CommentForm $commentForm \;
/* @var TagPost $post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $model->title ?></h1>

<div class="meta">
    <p>Автор: <?= $model->author->username ?> Дата публикации: <?= $model->publish_date ?> Категория: <?= $model->category->title ?></p>
</div>

<div>
    <?= $model->content ?>
</div>

<div class="tags">
    Тэги: <?php
    /** @var TagPost $postTag */
    foreach($model->getTagPost()->all() as $postTag) : ?>
        <?= $postTag->getTag()->one()->title ?>
    <?php endforeach; ?>
</div>

<div class="comments">
    <?php /** @var Comment $comment */ ?>
    <?php foreach($model->getPublishedComments()->models as $comment) : ?>
        <div class="comment">
            <h3><?= htmlspecialchars($comment->title) ?></h3>
            <div class="meta">Автор: <strong><?=isset($comment->author) ? $comment->author->username : null?></strong></div>
            <div><?= htmlspecialchars($comment->content) ?></div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->render('../comment/_form', [
    'model' => $commentForm
]) ?>
