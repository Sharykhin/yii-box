<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\catalog\Module;

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

            'date_created',
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

</div>
