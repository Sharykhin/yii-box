<?php

namespace app\modules\backend;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\controllers';

    public function init()
    {
        parent::init();

        $this->modules = [
            'users' => [
                // you should consider using a shorter namespace here!
                'class' => 'app\modules\backend\modules\users\Module',
            ],
        ];
        // custom initialization code goes here
    }
}
