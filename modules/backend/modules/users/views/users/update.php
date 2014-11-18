<?php

use yii\helpers\Html;
use app\modules\backend\modules\users\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Module::t('base', 'Update {modelClass}: ', [
    'modelClass' => 'Users',
]) . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base', 'Update');
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
