<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\backend\Module;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    if(Yii::$app->user->can('ROLE_ADMIN')) {
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                ['label' => '', 'url' => ['/site/index']],
                [
                    'label' => Module::t('base','Management'),'items'=>[
                        [ 'label'=>Module::t('base','Users'),'url'=>['/backend/users/users'],],
                        [ 'label'=>Module::t('base','Pages'),'url'=>['/backend/pages/pages'],],
                        [ 'label'=>Module::t('base','Gallery'),'url'=>['/backend/gallery'],],
                        '<li class="divider"></li>',
                        [ 'label'=>Module::t('base','Settings'),'url'=>['site/index'],],


                    ]
                ],
                '<form class="navbar-form navbar-left" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </form>',

            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->last_name,
                    'items'=>[
                        ['label'=>Module::t('base','Logout'),'url'=>['/site/logout'],'linkOptions'=>['data-method' => 'post']],
                        ['label'=>Module::t('base','Change password')]
                    ]
                ],
            ],
        ]);
        NavBar::end();
    }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name; ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
