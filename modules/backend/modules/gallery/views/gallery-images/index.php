<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\gallery\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\gallery\models\GalleryImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('base', 'Gallery: images');
$this->params['breadcrumbs'][] = ['label' =>  Module::t('base', 'Gallery: images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create gallery', []), ['create'], ['class' => 'btn btn-success']) ?>

        <?php echo Html::a(Module::t('base','Manage categories'),['/backend/gallery/gallery-categories'],['class'=>'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'category_id',
                'format'=>'raw',
                'value'=>function($item) {
                        return ($item->getCategories()->one())
                            ? Html::a($item->getCategories()->one()->title,['/backend/gallery/gallery-images/images','type'=>$item->getCategories()->one()->type])
                            : null;
                    }
            ],

            [
                'attribute' => 'status',
                'filter'=>[
                    '1'=>Yii::t('common','Enable'),
                    '0'=>Yii::t('common','Disable')
                ],
                'value' => function($item) {
                        return ($item->status) ? Yii::t('common','Enable') : Yii::t('common','Disable');
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
