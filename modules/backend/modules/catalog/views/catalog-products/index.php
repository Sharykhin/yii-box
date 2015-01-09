<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\catalog\Module;
use app\modules\backend\modules\catalog\models\CatalogProducts;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\catalog\models\CatalogProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('base', 'Catalog Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Add product', []), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Module::t('base', 'Manage categories', []), ['/backend/catalog/catalog-categories'], ['class' => 'btn btn-info']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'headerOptions'=>[
                    'class'=>'width-80'
                ],
            ],
            'title',
            'description:ntext',
            [
                'attribute'=>'status',
                'filter' => [
                    '0'=>Yii::t('common','Disable'),
                    '1'=>Yii::t('common','Enable')
                ],
                'value' => function($item) {
                        return ($item->status) ? Yii::t('common','Enable'): Yii::t('common','Disable');
                    }
            ],
            [
              'attribute' => 'photo_cropped',
              'format'=>'raw',
              'value'=>function($item) {
                       return '<img width="80" src="/'.CatalogProducts::UPLOADS_PRODUCTS_DIR.'/'.$item->photo_cropped.'" />';
               }
            ],
            [
              'attribute'=>'date_created',
               'value'=>function($item) {
                       $dateTime = new \DateTime($item->date_created);
                       return $dateTime->format("Y-m-d H:i");
                   }
            ],
            [
                'attribute' => 'category_id',
                'filter'=>$categories,
                'value' => function($item) {
                        return ($item->getCategory()->one()) ? $item->getCategory()->one()->title : null;
                    }
            ],
            // 'date_modified',
            // 'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    \app\assets\BootstrapDatePickerAsset::register($this);
    $this->registerJs('$(\'table input[name^="CatalogProductsSearch[date_"]\').datepicker({ format: \'yyyy-mm-dd\'});');
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
