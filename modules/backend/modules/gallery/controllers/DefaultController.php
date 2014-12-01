<?php

namespace app\modules\backend\modules\gallery\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/backend/gallery/gallery-images']);
    }
}
