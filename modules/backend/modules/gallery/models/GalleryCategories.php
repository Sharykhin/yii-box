<?php

namespace app\modules\backend\modules\gallery\models;
use app\modules\backend\modules\gallery\Module;
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
            ['title','unique'],
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
            'id' => Module::t('base', 'ID'),
            'title' => Module::t('base', 'Title'),
            'status' => Module::t('base', 'Status'),
        ];
    }
}
