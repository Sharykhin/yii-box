<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\backend\modules\catalog\models\CatalogProducts */

$this->title = Yii::t('base', 'Create {modelClass}', [
    'modelClass' => 'Catalog Products',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base', 'Catalog Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
