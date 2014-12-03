<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\backend\modules\gallery\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryCategories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Gallery: categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-categories-view">

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
            'title',
            [
                'attribute'=>'status',
                'value' => ($model->status) ? Yii::t('common','Enable') : Yii::t('common','Disable')
            ]

        ],
    ]) ?>

</div>
