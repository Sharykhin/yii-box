<?php

namespace app\modules\backend\modules\gallery\models;

use Yii;

/**
 * This is the model class for table "gallery_categories".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 */
class GalleryCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base', 'ID'),
            'title' => Yii::t('base', 'Title'),
            'status' => Yii::t('base', 'Status'),
        ];
    }
}
