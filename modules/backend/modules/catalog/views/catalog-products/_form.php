<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use karpoff\icrop\CropImageUpload;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\catalog\models\CatalogProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1'=>Yii::t('common','Enable'),
        '0'=>Yii::t('common','Disable'),
    ]) ?>

    <?= $form->field($model, 'photo')->widget(CropImageUpload::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
