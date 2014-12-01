<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'big_path')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'small_path')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('base', 'Create') : Yii::t('base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
