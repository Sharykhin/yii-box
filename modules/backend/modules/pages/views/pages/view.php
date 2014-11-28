<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\backend\Module as BackendModule;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\pages\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => BackendModule::t('base', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:url',
            [
                'attribute'=>'content',
                'format'=>'raw'
            ],
            'title',
            'date_created',
            'date_modified',
        ],
    ]) ?>

</div>
