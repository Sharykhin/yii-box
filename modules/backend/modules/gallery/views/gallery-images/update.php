<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryImages */

$this->title = Yii::t('base', 'Update {modelClass}: ', [
    'modelClass' => 'Gallery Images',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base', 'Gallery Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base', 'Update');
?>
<div class="gallery-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
