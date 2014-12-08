<?php

use yii\db\Schema;
use yii\db\Migration;

class m141205_154403_create_gallery_categories extends Migration
{
    public function up()
    {
        $this->createTable('gallery_categories',[
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'type'=>Schema::TYPE_TEXT. ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('gallery_categories');
        return false;
    }
}
