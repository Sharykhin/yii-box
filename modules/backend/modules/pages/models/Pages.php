<?php

namespace app\modules\backend\modules\pages\models;
use app\modules\backend\modules\pages\Module;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $url
 * @property string $content
 * @property string $title
 * @property string $date_created
 * @property string $date_modified
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'title', 'date_created', 'date_modified'], 'required'],
            [['content'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['url', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('base', 'ID'),
            'url' => Module::t('base', 'Url'),
            'content' => Module::t('base', 'Content'),
            'title' => Module::t('base', 'Title'),
            'date_created' => Module::t('base', 'Date Created'),
            'date_modified' => Module::t('base', 'Date Modified'),
        ];
    }
}