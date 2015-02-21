<?php

use yii\db\Schema;
use yii\db\Migration;

class m141116_104920_tags extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tags}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%tag_post}}', [
            'tag_id' => Schema::TYPE_INTEGER,
            'post_id' => Schema::TYPE_INTEGER
        ], $tableOptions);

        $this->createIndex('FK_tag', '{{%tag_post}}', 'tag_id');
        $this->addForeignKey(
            'FK_tag_post', '{{%tag_post}}', 'tag_id', '{{%tags}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_post', '{{%tag_post}}', 'post_id');
        $this->addForeignKey(
            'FK_post_tag', '{{%tag_post}}', 'post_id', '{{%post}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('FK_tag_post', '{{%tag_post}}');
        $this->dropForeignKey('FK_post_tag', '{{%tag_post}}');

        $this->dropTable('{{%tags}}');
        $this->dropTable('{{%tag_post}}');
    }
}
