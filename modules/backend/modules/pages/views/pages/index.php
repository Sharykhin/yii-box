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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'content:ntext',
            'title',
            'date_created',
            // 'date_modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
