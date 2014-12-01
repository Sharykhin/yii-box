<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryCategories */

$this->title = Yii::t('base', 'Create {modelClass}', [
    'modelClass' => 'Gallery Categories',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base', 'Gallery Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
