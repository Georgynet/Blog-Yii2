<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'new_password')->passwordInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        User::STATUS_DELETED => Yii::t('backend', 'Inactive'),
        User::STATUS_ACTIVE => Yii::t('backend', 'Active'),
    ]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        User::ROLE_USER => Yii::t('backend', 'User'),
        User::ROLE_ADMIN => Yii::t('backend', 'Administrator'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
