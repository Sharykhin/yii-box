<?php

namespace app\modules\backend\modules\catalog;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\modules\catalog\controllers';

    public $layout='/../../modules/backend/views/layouts/layout';

    public function init()
    {
        parent::init();
        $this->registerTranslations();

    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['app/catalog/*'] = [
            'class'=>'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@app/modules/backend/modules/catalog/messages',
            'fileMap' => [
                'app/catalog/base' => 'base.php',
                'app/catalog/error' => 'errors.php'
            ]
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/catalog/' . $category, $message, $params, $language);
    }
}
