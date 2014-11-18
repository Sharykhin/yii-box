<?php
namespace app\modules\backend\modules\users;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\modules\users\controllers';

    public $layout='/../../modules/backend/views/layouts/layout';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app/users/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@app/modules/backend/modules/users/messages',
            'fileMap' => [
                'app/users/base' => 'base.php',
                'app/users/error' => 'errors.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/users/' . $category, $message, $params, $language);
    }
}

