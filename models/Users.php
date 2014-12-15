<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
 * @property string $avatar
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // holds the password confirmation word
    public $repeatPassword;
    // holds selected role for user
    public  $role;

    const UPLOADS_AVATARS_DIR='uploads/users/avatars';

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
            [['avatar'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
            [['email'],'email']
        ];
    }

    public function afterFind()
    {
        $rolesArray = array_keys(Yii::$app->authManager->getRolesByUser($this->id));
        $this->role = (!empty($rolesArray)) ?  $rolesArray[0] : false;
    }

    public function beforeSave($insert)
    {
        $avatar = UploadedFile::getInstance($this, 'avatar');
        if(!is_null($avatar)) {
            if($this->avatar) {
                if(file_exists((Yii::$app->basePath.'/web/'.self::UPLOADS_AVATARS_DIR.'/'.$this->avatar))) {
                   unlink(Yii::$app->basePath . '/web/' . self::UPLOADS_AVATARS_DIR . '/' . $this->avatar);
                }
            }
            $this->avatar =$avatar->baseName.'.'.$avatar->extension;
        }
        return parent::beforeSave($insert);
    }

    public function afterDelete()
    {
        if(!is_null($this->attributes['avatar'])) {
            unlink(Yii::$app->basePath.'/web/'.self::UPLOADS_AVATARS_DIR.'/'.$this->attributes['avatar']);
        }
    }

    public function removeAvatar()
    {
        unlink(Yii::$app->basePath.'/web/'.self::UPLOADS_AVATARS_DIR.'/'.$this->attributes['avatar']);
    }

    public function afterSave($insert)
    {
        if(Yii::$app->request->isPost && isset(Yii::$app->request->post()['Users'])) {
            $roleTitle = Yii::$app->request->post()['Users']['role'];
            $authManager = Yii::$app->authManager;
            $role = $authManager->getRole($roleTitle);
            $userRoles = $authManager->getRolesByUser($this->id);
            foreach($userRoles as $roleKey=>$roleInstance):
                $authManager->revoke($roleInstance,$this->id);
            endforeach;
            $authManager->assign($role,$this->id);
        }
        $this->avatar = UploadedFile::getInstance($this, 'avatar');
        if(!is_null($this->avatar)) {
            $this->avatar->saveAs(self::UPLOADS_AVATARS_DIR . '/' . $this->avatar->baseName . '.' . $this->avatar->extension);
        }

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
            'avatar'=>Yii::t('app','Avatar')
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
