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
 */
class GalleryImages extends \yii\db\ActiveRecord
{
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
            [['big_path', 'small_path'], 'required'],
            [['status'], 'integer'],
            [['big_path', 'small_path'], 'string', 'max' => 255]
        ];
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

    public function getCategories()
    {
        //return $this->hasMany(GalleryCategories::className(), ['category_id' => 'id']);
        return $this->hasOne(GalleryCategories::className(), ['id' => 'category_id']);
    }
}
