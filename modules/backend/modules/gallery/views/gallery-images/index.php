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
    <?php if(Yii::$app->session->hasFlash('success')) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>

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
                        return ($item->getCategory()->one())
                            ? Html::a($item->getCategory()->one()->title,['/backend/gallery/gallery-images/images','type'=>$item->getCategory()->one()->type])
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
                        return ($item->getCategory()->one()->status) ? Yii::t('common','Enable') : Yii::t('common','Disable');
                    }
            ],

            [
              'label'=>Module::t('base','Images number'),
              'value'=>function($item) {
                       return $item->getCategory()->one()->getImages()->count();
               }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{update} {delete}',
                'buttons'=>[
                    'update' => function ($url, $model, $key) {
                            $url=['/backend/gallery/gallery-images/images','type'=>$model->getCategory()->one()->type];
                            return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url);
                        },
                    'delete' => function($url,$model) {
                            $url=['/backend/gallery/gallery-images/remove-gallery','id'=>$model->getCategory()->one()->id];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                                'data-confirm'=>Yii::t('app','Are you sure to delete your avatar?'),
                                'data-method'=>'post',
                                'data-pjax'=>0
                            ]);
                    }
                ]

            ],
        ],
    ]); ?>


</div>
