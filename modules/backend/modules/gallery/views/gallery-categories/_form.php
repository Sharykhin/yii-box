<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => Yii::t('common','Enable'),
        '0' => Yii::t('common','Disable')
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
