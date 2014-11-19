<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     */
    public function actionIndex()
    {
        $this->stdout('rbac manager: there are two available methods'.PHP_EOL,Console::FG_YELLOW);
        $this->stdout(' -create'.PHP_EOL.' -remove'.PHP_EOL,Console::FG_BLUE);
    }

    public function actionCreate()
    {
       $this->stdout("Enter name of role: ",Console::FG_YELLOW);
       $roleName = trim(fgets(STDIN,1024));
       $authManager = \Yii::$app->authManager;
       $roles = $authManager->getRoles();
       if(array_key_exists($roleName,$roles)) {
           $this->stdout("Current role already exists, do you want to use it? [yes]|[no]: ",Console::FG_BLUE);
           $answer = trim(fgets(STDIN,1024));
           if($answer === 'yes') {
               $roleToAssign = $roles[$roleName];
           } else {
               return $this->actionCreate();
           }

       } else {
           $roleToAssign = $authManager->createRole($roleName);
           $authManager->add($roleToAssign);
       }
       $this->stdout("Enter username: ",Console::FG_YELLOW);
       $user = trim(fgets(STDIN,1024));
       $row = (new \yii\db\Query())->select('id')->from('users')->where(['username'=>$user])->one();
        if(is_array($row) && isset($row['id'])) {

            $authManager->assign($roleToAssign,$row['id']);
            $this->stdout("Role has been successfully assignment to user".PHP_EOL,Console::FG_GREEN);
        } else {
            $this->stdout("Current user doesn't exist in database.".PHP_EOL,Console::FG_RED);

        }
        return 1;

    }

    public function actionRemove()
    {
        $this->stdout("Enter role, which should be removed from user: ",Console::FG_YELLOW);
        $roleName = trim(fgets(STDIN,1024));
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        if(!array_key_exists($roleName,$roles)) {
            $this->stdout("There is no such role in application".PHP_EOL,Console::FG_RED);
            return 1;

        } else {
            $this->stdout("Enter username: ",Console::FG_YELLOW);
            $user = trim(fgets(STDIN,1024));
            $row = (new \yii\db\Query())->select('id')->from('users')->where(['username'=>$user])->one();
            if(is_array($row) && isset($row['id'])) {
               \Yii::$app
                   ->db
                   ->createCommand("DELETE
                                      FROM auth_assignment
                                      WHERE item_name=:role_name
                                      AND user_id=:id",
                       ['role_name'=>$roleName,':id'=>$row['id']])->execute();
                $this->stdout("Role has been successfully removed from user".PHP_EOL,Console::FG_GREEN);
            } else {
                $this->stdout("Current user doesn't exist in database.".PHP_EOL,Console::FG_RED);

            }
        }
    }




}
