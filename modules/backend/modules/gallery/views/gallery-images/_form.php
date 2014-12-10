<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\backend\modules\gallery\models\GalleryCategories;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories); ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => Yii::t('common','Enable'),
        '0' => Yii::t('common','Disable')
    ]) ?>

    <?php
        $field = $form->field($model, 'big_path');
        $field->template = "{input}\n{hint}\n{error}";
        echo $field->hiddenInput();
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('base', 'Create') : Yii::t('base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
