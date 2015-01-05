<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;
use app\modules\backend\modules\catalog\Module;
use karpoff\icrop\CropImageUploadBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "catalog_products".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $photo
 * @property string $photo_crop
 * @property string $photo_cropped
 * @property integer $status
 * @property string $date_created
 * @property string $date_modified
 * @property integer $category_id
 *
 * @property CatalogCategories $category
 */
class CatalogProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_products';
    }

    const UPLOADS_PRODUCTS_DIR='uploads/products';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status', 'category_id'], 'required'],
            [['description'], 'string'],
            ['photo', 'file', 'extensions' => 'jpeg, gif, png', 'on' => ['insert', 'update']],
            [['status', 'category_id'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['title', 'photo', 'photo_crop', 'photo_cropped'], 'string', 'max' => 255]
        ];
    }

    public  function behaviors()
    {
        return [
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'photo',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/uploads/products',
                'url' => '@web/uploads/products',
                'ratio' => 1,
                'crop_field' => 'photo_crop',
                'cropped_field' => 'photo_cropped',
            ],
        ];
    }


    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $this->date_modified=$date->format("Y-m-d H:i:s");
        if($insert) {
            $this->date_created=$date->format("Y-m-d H:i:s");
        }

        $photo = UploadedFile::getInstance($this, 'photo');
        if(!is_null($photo)) {
            if($this->photo) {
                if(file_exists((Yii::$app->basePath.'/web/'.self::UPLOADS_PRODUCTS_DIR.'/'.$this->photo))) {
                    unlink(Yii::$app->basePath . '/web/' . self::UPLOADS_PRODUCTS_DIR . '/' . $this->photo);
                }
            }
            $this->photo =$photo->baseName.'.'.$photo->extension;
            //$photo->saveAs(self::UPLOADS_PRODUCTS_DIR . '/' . $this->photo);
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert)
    {
        $photo = UploadedFile::getInstance($this, 'photo');
        if(!is_null($photo)) {
            $photo->saveAs(self::UPLOADS_PRODUCTS_DIR . '/' . $this->photo);
        }
        return parent::afterSave($insert,[]);
    }

    public function afterDelete()
    {
        $photoCroped = $this->photo_cropped;
        unlink(Yii::$app->basePath.'/web/'.self::UPLOADS_PRODUCTS_DIR.'/'.$photoCroped);
        return parent::afterDelete();
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('base', 'ID'),
            'title' => Module::t('base', 'Title'),
            'description' => Module::t('base', 'Description'),
            'photo' => Module::t('base', 'Photo'),
            'photo_crop' => Module::t('base', 'Photo Crop'),
            'photo_cropped' => Module::t('base', 'Photo Cropped'),
            'status' => Module::t('base', 'Status'),
            'date_created' => Module::t('base', 'Date Created'),
            'date_modified' => Module::t('base', 'Date Modified'),
            'category_id' => Module::t('base', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CatalogCategories::className(), ['id' => 'category_id']);
    }
}
