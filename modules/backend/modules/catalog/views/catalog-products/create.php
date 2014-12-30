<?php

use yii\helpers\Html;
use app\modules\backend\modules\catalog\Module;


/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\catalog\models\CatalogProducts */

$this->title = Module::t('base', 'Add product', []);
$this->params['breadcrumbs'][] = ['label' => Module::t('base', 'Catalog Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories'=>$categories
    ]) ?>

</div>
