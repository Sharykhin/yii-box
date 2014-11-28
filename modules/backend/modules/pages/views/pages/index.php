<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\Module as BackendModule;
use app\modules\backend\modules\pages\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = BackendModule::t('base', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    --><?php //\yii\widgets\Pjax::begin(); ?>
    
    <?= GridView::widget([
        'id' => 'page-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'footerRowOptions'=>[
            'class'=>'datepicker',
            'data-date-format'=>'yyyy-mm-dd'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'label'=>'ID',
                'headerOptions'=>[
                    'class'=>'width-80'
                ]
            ],
            'url:url',
            'title',
            [
              'attribute'=>'date_created',
              'filterInputOptions'=>[
                 'class'=>'datepicker form-control',
                 'data-date-format'=>'yyyy-mm-dd'

              ]
            ],
            [
                'attribute'=>'date_modified',
                'filterInputOptions'=>[
                    'class'=>'datepicker form-control',
                    'data-date-format'=>'yyyy-mm-dd'

                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<!--    --><?php //\yii\widgets\Pjax::end(); ?>

</div>
<?php
\app\assets\BootstrapDatePickerAsset::register($this);
$this->registerJs('$(".datepicker").datepicker();');
?>