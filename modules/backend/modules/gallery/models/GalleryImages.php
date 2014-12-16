<?php

namespace app\modules\backend\modules\gallery\models;

use app\modules\backend\modules\gallery\Module;
use Yii;

/**
 * This is the model class for table "gallery_images".
 *
 * @property integer $id
 * @property string $big_path
 * @property string $small_path
 * @property integer $category_id
 * @property integer $status
 *
 * @property GalleryCategories $category
 */
class GalleryImages extends \yii\db\ActiveRecord
{

    private $fileStorage = 'vendors/jquery-fileupload/server/php/files';

    public function getPathToSmall()
    {
        return Yii::$app->urlManager->baseUrl.'/'.$this->fileStorage.'/thumbnail';
    }

    public function getPathToBig()
    {
        return Yii::$app->urlManager->baseUrl.'/'.$this->fileStorage;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'status'], 'integer'],
        ];
    }

    public function beforeSave($insert)
    {
        $this->big_path = $this->getPathToBig().'/'.$this->big_path;
        $this->small_path = $this->getPathToSmall().'/'.$this->small_path;
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base', 'ID'),
            'big_path' => Yii::t('base', 'Big Path'),
            'small_path' => Yii::t('base', 'Small Path'),
            'category_id' => Module::t('base', 'Type'),
            'status' => Module::t('base', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GalleryCategories::className(), ['id' => 'category_id']);
    }
}
