<?php

namespace app\modules\backend;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\controllers';

    public function init()
    {
        parent::init();

        $this->modules = [
            'users' => [
                'class' => 'app\modules\backend\modules\users\Module',
            ],
        ];
        $this->registerTranslations();
        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app/backend/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@app/modules/backend/messages',
            'fileMap' => [
                'app/backend/base' => 'base.php',
                'app/backend/error' => 'errors.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/backend/' . $category, $message, $params, $language);
    }
}
