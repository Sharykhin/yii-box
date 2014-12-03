<?php

namespace app\modules\backend\modules\gallery;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\modules\gallery\controllers';

    public $layout='/../../modules/backend/views/layouts/layout';

    public function init()
    {
        parent::init();

        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app/gallery/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@app/modules/backend/modules/gallery/messages',
            'fileMap' => [
                'app/gallery/base' => 'base.php',
                'app/gallery/error' => 'errors.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/gallery/' . $category, $message, $params, $language);
    }
}
