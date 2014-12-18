<?php

namespace app\modules\backend\modules\gallery\controllers;

use Yii;
use app\modules\backend\modules\gallery\models\GalleryImages;
use app\modules\backend\modules\gallery\models\GalleryCategories;
use app\modules\backend\modules\gallery\models\GalleryImagesSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\backend\modules\gallery\Module;

/**
 * GalleryImagesController implements the CRUD actions for GalleryImages model.
 */
class GalleryImagesController extends Controller
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
     * Lists all GalleryImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GalleryImagesSearch();
//        $dataProvider = $searchModel->search(GalleryImages::find()->groupBy('category_id'));
        $dataProvider = new ActiveDataProvider([
            'query' => GalleryImages::find()->groupBy('category_id'),
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryImages model.
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
     * Creates a new GalleryImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryImages();

        $categoriesInstanses = GalleryCategories::find()->all();
        $categories = [];
        if(!empty($categoriesInstanses)) {
            foreach($categoriesInstanses as $categoryInstance) :
                $hasImages = sizeof($categoryInstance->getImages()->all()) ? true : false;
                if(!$hasImages) {
                    $categories[$categoryInstance->id]=$categoryInstance->title;
                }
            endforeach;
        }

        if(Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $galleryData = $postData[$model->formName()];
            $galleryImages = explode(',',$galleryData['big_path']);
            $numberOfImages = sizeof($galleryImages);
            if($numberOfImages > 0) {
                for($i=0;$i<$numberOfImages;$i++) {
                    $model = new GalleryImages();
                    $model->load([
                        $model->formName()=>[
                            'status'=>$galleryData['status'],
                            'category_id'=>$galleryData['category_id'],
                            'small_path'=>$galleryImages[$i],
                            'big_path'=>$galleryImages[$i]
                        ]
                    ]);
                    $model->save();
                }
            }

            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
                'categories'=>$categories
            ]);
        }
    }

    /**
     * Updates an existing GalleryImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $file
     * @return \yii\web\Response
     */
    public function actionDelete($file)
    {
        $galleryModel = new GalleryImages();
        GalleryImages::findOne(['big_path'=>$galleryModel->getPathToBig().'/'.$file])->delete();

    }

    public function actionRemoveGallery($id)
    {

        $images = GalleryImages::findAll(['category_id'=>$id]);
        if(!empty($images)) {
            foreach($images as $image) :
                @unlink(Yii::$app->basePath.'/web'.$image->big_path);
                @unlink(Yii::$app->basePath.'/web'.$image->small_path);
                $image->delete();
            endforeach;
        }

        Yii::$app->getSession()->setFlash('success', Module::t('base','Gallery has been deleted successfully'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the GalleryImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GalleryImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GalleryImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImages($type)
    {
        $category = GalleryCategories::findOne(['type'=>$type]);
        if($category instanceof GalleryCategories) {
            $images = $category->getImages()->all();
        }
        return $this->render('images', [
            'images' => $images,
            'category'=>$category
        ]);
    }

    public function actionSaveImages()
    {
        if(Yii::$app->request->isAjax) {
            $image = Yii::$app->request->bodyParams['image'];
            $categoryId = Yii::$app->request->bodyParams['category_id'];
            $model = new GalleryImages();
            $model->load([
                $model->formName()=>[
                    'status'=>1,
                    'category_id'=>$categoryId,
                    'small_path'=>$image,
                    'big_path'=>$image
                ]
            ]);
            $model->save();
        }
    }

    public function actionImagesList()
    {
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->bodyParams['category_id'];
            $category = GalleryCategories::findOne(['id'=>$id]);
            if($category instanceof GalleryCategories) {
                $images = $category->getImages()->all();
            }

            return $this->renderPartial('imagesList',[
                'images' => $images,
            ]);
        }
    }
}
