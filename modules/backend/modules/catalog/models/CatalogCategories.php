<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;
use app\modules\backend\modules\catalog\Module;

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
            'id' => Module::t('base', 'ID'),
            'title' => Module::t('base', 'Title'),
            'parent_id' => Module::t('base', 'Parent'),
            'status' => Module::t('base', 'Status'),
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

    public static function getAvailableCategories($id=false)
    {
        $categories = [];
        $availableCategories =  CatalogCategories::find()->all();
        if(!empty($availableCategories)) :
            foreach($availableCategories as $availableCategory) :
                if($id !== false && $id && (intval($availableCategory->id) === intval($id))) :
                    continue;
                endif;
                $categories[$availableCategory->id]=$availableCategory->title;
            endforeach;
        endif;
        return $categories;
    }
}
