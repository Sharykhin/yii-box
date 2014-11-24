<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\backend\modules\users\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'first_name',
            'last_name',
            'role',
            [
                'attribute'=>'avatar',
                'label' => Yii::t('app','Avatar'),
                'format'=>'raw',
                'value' =>Html::img("uploads/users/avatars/".(($model->avatar) ? $model->avatar : 'default_avatar.jpg' ),['width'=>200]) ,
            ],
        ],
    ]) ?>

</div>
