<?php

use yii\helpers\Html;
use app\modules\backend\modules\pages\Module;
use app\modules\backend\Module as BackendModule;
use yii\web\JqueryAsset;
use app\assets\CkEditorAsset;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\pages\models\Pages */

$this->registerJsFile('js/modules/backend/pages/pages.js',['depends'=>[CkEditorAsset::className()]]);

$this->title = Module::t('base', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => BackendModule::t('base', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
