<?php

namespace app\modules\backend\modules\catalog\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/backend/catalog/catalog-products']);
    }
}
