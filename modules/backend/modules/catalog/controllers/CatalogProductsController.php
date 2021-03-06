<?php

namespace app\modules\backend\modules\catalog\controllers;

use Yii;
use app\modules\backend\modules\catalog\models\CatalogProducts;
use app\modules\backend\modules\catalog\models\CatalogProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\backend\modules\catalog\models\CatalogCategories;

/**
 * CatalogProductsController implements the CRUD actions for CatalogProducts model.
 */
class CatalogProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CatalogProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = CatalogCategories::getAvailableCategories();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories'=>$categories,
        ]);
    }

    /**
     * Displays a single CatalogProducts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CatalogProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogProducts();
        $categories = CatalogCategories::getAvailableCategories();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories'=>$categories
            ]);
        }
    }

    /**
     * Updates an existing CatalogProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = CatalogCategories::getAvailableCategories($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories'=>$categories
            ]);
        }
    }

    /**
     * Deletes an existing CatalogProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CatalogProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
