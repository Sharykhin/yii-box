<?php

use yii\helpers\Html;
use app\modules\backend\modules\gallery\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\gallery\models\GalleryCategories */

$this->title = Module::t('base', 'Create category', []);
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Gallery: categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
