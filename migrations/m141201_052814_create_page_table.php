<?php

use yii\db\Schema;
use yii\db\Migration;

class m141201_052814_create_page_table extends Migration
{
    public function up()
    {
        $this->createTable('pages',[
            'id' => 'pk',
            'url' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'content'=>Schema::TYPE_TEXT. ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'date_created' => Schema::TYPE_DATE. ' NOT NULL',
            'date_modified' => Schema::TYPE_DATE. ' NOT NULL',
        ]);
    }

    public function down()
    {
       $this->dropTable('pages');
    }
}
