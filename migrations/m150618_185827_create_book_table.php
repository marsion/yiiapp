<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_185827_create_book_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'author' => Schema::TYPE_INTEGER . ' NOT NULL ',
            'description' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
