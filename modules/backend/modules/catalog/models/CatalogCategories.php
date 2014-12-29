<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "catalog_categories".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property integer $status
 *
 * @property CatalogCategories $parent
 * @property CatalogCategories[] $catalogCategories
 * @property CatalogProducts[] $catalogProducts
 */
class CatalogCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['parent_id', 'status'], 'integer'],
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
            'parent_id' => Yii::t('base', 'Parent ID'),
            'status' => Yii::t('base', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CatalogCategories::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogCategories()
    {
        return $this->hasMany(CatalogCategories::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogProducts()
    {
        return $this->hasMany(CatalogProducts::className(), ['category_id' => 'id']);
    }
}
