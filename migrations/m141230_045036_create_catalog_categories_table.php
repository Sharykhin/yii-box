<?php

use yii\db\Schema;
use yii\db\Migration;

class m141230_045036_create_catalog_categories_table extends Migration
{
    public function up()
    {
        $this->createTable('catalog_categories',[
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'parent_id'=>Schema::TYPE_INTEGER. ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->addForeignKey('catalog_parent_key','catalog_categories','parent_id','catalog_categories','id','cascade','cascade');
    }

    public function down()
    {
        $this->dropTable('catalog_categories');
        return false;
    }
}
