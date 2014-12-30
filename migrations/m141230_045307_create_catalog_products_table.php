<?php

use yii\db\Schema;
use yii\db\Migration;

class m141230_045307_create_catalog_products_table extends Migration
{
    public function up()
    {
        $this->createTable('catalog_products',[
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT. ' NOT NULL',
            'date_created' => Schema::TYPE_DATE.' NOT NULL',
            'date_modified' => Schema::TYPE_DATE. 'NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
            'category_id' => Schema::TYPE_INTEGER.' NOT NULL'
        ]);

        $this->addForeignKey('product_category_key','catalog_products','category_id','catalog_categories','id','cascade','cascade');
    }

    public function down()
    {
        $this->dropTable('catalog_products');
        return false;
    }
}
