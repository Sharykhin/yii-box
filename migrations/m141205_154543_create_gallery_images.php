<?php

use yii\db\Schema;
use yii\db\Migration;

class m141205_154543_create_gallery_images extends Migration
{
    public function up()
    {
        $this->createTable('gallery_images',[
            'id' => 'pk',
            'big_path' => Schema::TYPE_STRING . ' NOT NULL',
            'small_path'=>Schema::TYPE_TEXT. ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('gallery_images');
        return false;
    }
}
