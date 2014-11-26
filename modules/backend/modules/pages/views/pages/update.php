<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\pages\models\Pages */

$this->title = Yii::t('base', 'Update {modelClass}: ', [
    'modelClass' => 'Pages',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base', 'Update');
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>