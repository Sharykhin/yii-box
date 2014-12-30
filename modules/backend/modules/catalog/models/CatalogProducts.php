<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;
use app\modules\backend\modules\catalog\Module;

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
            [['title', 'description', 'status', 'category_id'], 'required'],
            [['description'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $this->date_modified=$date->format("Y-m-d H:i:s");
        if($insert) {
            $this->date_created=$date->format("Y-m-d H:i:s");
        }
        return parent::beforeSave($insert);
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
