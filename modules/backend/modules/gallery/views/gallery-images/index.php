<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\backend\modules\gallery\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\modules\gallery\models\GalleryImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base', 'Gallery Images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base', 'Create {modelClass}', [
    'modelClass' => 'Gallery Images',
]), ['create'], ['class' => 'btn btn-success']) ?>

        <?php echo Html::a(Module::t('base','Manage categories'),['/backend/gallery/gallery-categories'],['class'=>'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'big_path',
            'small_path',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
