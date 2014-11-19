<?php

namespace app\modules\backend\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout='layout';

    public function actionIndex()
    {
        if(\Yii::$app->user->can('ROLE_ADMIN')) {

            return $this->render('index');
        } else {

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                if(!Yii::$app->user->can('ROLE_ADMIN')) {
                    $authManager = Yii::$app->authManager;
                    $role = $authManager->createRole('ROLE_ADMIN');
                    $role->description = 'Admin role';
                    $authManager->add($role);
                    $authManager->assign($role,Yii::$app->user->id);
                }
                return $this->redirect(['/backend']);
            }
            return $this->render('sign_in',[
                'model' => $model,
            ]);
        }

    }


}
