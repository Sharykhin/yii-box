<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\gallery\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\gallery\models\GalleryCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('base', 'Gallery: categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create category'), ['create'], ['class' => 'btn btn-success']) ?>

        <?php echo Html::a(Module::t('base','Manage images'),['/backend/gallery/gallery-images'],['class'=>'btn btn-info']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
