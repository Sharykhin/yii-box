<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\users\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('base', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('base', 'Create {modelClass}', [
    'modelClass' => 'Users',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'first_name',
            'last_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
