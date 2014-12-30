<?php

use yii\helpers\Html;
use app\modules\backend\modules\catalog\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\catalog\models\CatalogCategories */

$this->title = Module::t('base', 'Create category', []);
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Catalog Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
