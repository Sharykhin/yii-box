<?php

use yii\helpers\Html;
use app\modules\backend\modules\gallery\Module;
/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryCategories */

$this->title = Yii::t('common', 'Update') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Gallery: categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="gallery-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
