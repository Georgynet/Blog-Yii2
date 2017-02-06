<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::t('backend', 'My Yii Blog');
?>
<div class="site-index">

    <div class="body-content">

        <h3><?= Yii::t('backend', 'Blog') ?></h3>
        <ul class="nav nav-pills">
            <li><a href="<?= Url::toRoute('post/index'); ?>"><?= Yii::t('backend', 'Posts') ?></a></li>
            <li><a href="<?= Url::toRoute('category/index'); ?>"><?= Yii::t('backend', 'Categories') ?></a></li>
            <li><a href="<?= Url::toRoute('tags/index'); ?>"><?= Yii::t('backend', 'Tags') ?></a></li>
            <li><a href="<?= Url::toRoute('comment/index'); ?>"><?= Yii::t('backend', 'Comments') ?></a></li>
            <li><a href="<?= Url::toRoute('user/index'); ?>"><?= Yii::t('backend', 'Users') ?></a></li>
        </ul>

    </div>
</div>
