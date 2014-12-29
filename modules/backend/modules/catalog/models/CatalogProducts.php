<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "catalog_products".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status', 'date_created', 'date_modified', 'category_id'], 'required'],
            [['description'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
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
            'description' => Yii::t('base', 'Description'),
            'status' => Yii::t('base', 'Status'),
            'date_created' => Yii::t('base', 'Date Created'),
            'date_modified' => Yii::t('base', 'Date Modified'),
            'category_id' => Yii::t('base', 'Category ID'),
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
