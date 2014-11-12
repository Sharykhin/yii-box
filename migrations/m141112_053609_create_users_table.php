<?php

use yii\db\Schema;
use yii\db\Migration;

class m141112_053609_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => 'pk',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NULL',
            'password'=> Schema::TYPE_STRING . ' NOT NULL',
            'salt'=> Schema::TYPE_STRING . '  NULL',
            'first_name'=> Schema::TYPE_STRING . '  NULL',
            'last_name'=> Schema::TYPE_STRING . '  NULL',

        ]);

        echo "Table users has been created". PHP_EOL;
    }

    public function down()
    {
        $this->dropTable('users');
        echo "Table users has been dropped" . PHP_EOL;

        return false;
    }
}
