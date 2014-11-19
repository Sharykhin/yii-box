<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?php if(Yii::$app->controller->action->id === 'create') { ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => 255]) ?>
    <?php } ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255]) ?>
    <?php if(Yii::$app->user->can('ROLE_SUPER_ADMIN')) { ?>
        <?php
            $roles = Yii::$app->authManager->getRoles();
            $availableRoles=[];
            foreach($roles as $roleKey=>$roleInstance) :
                $availableRoles[$roleKey]=$roleInstance->name;
            endforeach;
        ?>
        <?php echo $form->field($model, 'role')->dropDownList($availableRoles); ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
