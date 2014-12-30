<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\catalog\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\catalog\models\CatalogCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('base', 'Catalog Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create category', []), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Module::t('base', 'Manage products', []), ['/backend/catalog/catalog-products'], ['class' => 'btn btn-info']) ?>
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
            [
              'attribute' => 'parent_id',
              'filter'=>$categories,
              'value' => function($item) {
                       return ($item->getParent()->one()) ? $item->getParent()->one()->title : null;
              }
            ],
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


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
