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
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(); ?>

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
            'date_created',
            'date_modified',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    \app\assets\BootstrapDatePickerAsset::register($this);
    $this->registerJs('$(\'table input[name^="PagesSearch[date_"]\').datepicker({ format: \'yyyy-mm-dd\'});');
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
