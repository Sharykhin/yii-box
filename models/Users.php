<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $role
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // holds the password confirmation word
    public $repeatPassword;
    // holds selected role for user
    public  $role;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [ 'repeatPassword', 'compare', 'compareAttribute'=>'password'],
            [['username', 'email', 'password'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['email'],'email']
        ];
    }

    public function afterSave($insert)
    {
        $roleTitle = Yii::$app->request->post()['Users']['role'];
        $authManager = Yii::$app->authManager;
        $role = $authManager->createRole($roleTitle);
        $role->description = $roleTitle.' role';
        $authManager->add($role);
        $authManager->assign($role,$this->id);
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app','Username'),
            'email' => Yii::t('app','Email'),
            'password' => Yii::t('app','Password'),
            'first_name' => Yii::t('app','First Name'),
            'last_name' => Yii::t('app','Last Name'),
            'repeatPassword'=>Yii::t('app','Repeat password'),
            'role'=>Yii::t('app','Role'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Users::findOne(['id'=>$id]);
        return ($user instanceof Users && !is_null($user)) ? new static($user->attributes) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {}

    /**
     * @inheritdoc
     */
    public function getAuthKey() {}

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {}


}
