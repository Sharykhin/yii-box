<?php

use yii\helpers\Html;
use app\modules\backend\modules\users\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Module::t('base', 'Create {modelClass}', [
    'modelClass' => 'Users',
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
