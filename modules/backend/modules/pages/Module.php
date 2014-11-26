<?php

namespace app\modules\backend\modules\pages;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\modules\pages\controllers';

    public $layout='/../../modules/backend/views/layouts/layout';

    public function init()
    {
        parent::init();
        $this->registerTranslations();

    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app/pages/*']=[
          'class' => 'yii\i18n\PhpMessageSource',
           'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@app/modules/backend/modules/pages/messages',
            'fileMap' => [
                'app/pages/base' => 'base.php',
                'app/pages/error' => 'errors.php'
            ]
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/pages/' . $category, $message, $params, $language);
    }
}