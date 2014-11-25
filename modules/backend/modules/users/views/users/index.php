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
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute'=>'id',
              'label'=>'ID',
              'headerOptions'=>[
                  'class'=>'width-80'
              ],
              'options'=>[
                  'data-class'=>'123'
              ]
            ],

            'username',
            'email:email',
            'first_name',
            'last_name',
            [
                'attribute'=>'avatar',
                'format'=>'raw',
                'label'=>Yii::t('app','Avatar'),
                'value'=>function($model) {
                    $avatar = ($model->avatar) ? $model->avatar : 'default_avatar.jpg';
                    return Html::img('uploads/users/avatars/'.$avatar,['width'=>80]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
