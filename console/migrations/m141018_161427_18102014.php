<?php

use common\models\Post;
use yii\db\Schema;
use yii\db\Migration;

class m141018_161427_18102014 extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'anons' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'category_id' => Schema::TYPE_INTEGER,
            'author_id' => Schema::TYPE_INTEGER,
            'publish_status' => "enum('" . Post::STATUS_DRAFT . "','" . Post::STATUS_PUBLISH . "') NOT NULL DEFAULT '" . Post::STATUS_DRAFT . "'",
            'publish_date' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('FK_post_author', '{{%post}}', 'author_id');
        $this->addForeignKey(
            'FK_post_author', '{{%post}}', 'author_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_post_category', '{{%post}}', 'category_id');
        $this->addForeignKey(
            'FK_post_category', '{{%post}}', 'category_id', '{{%category}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%category}}');
    }
}
