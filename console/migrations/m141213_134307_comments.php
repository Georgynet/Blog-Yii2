<?php

use common\models\Comment;
use yii\db\Schema;
use yii\db\Migration;

class m141213_134307_comments extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'pid' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_STRING . ' NOT NULL',
            'publish_status' => "enum('" . Comment::STATUS_MODERATE . "','" . Comment::STATUS_PUBLISH . "') NOT NULL DEFAULT '" . Comment::STATUS_MODERATE . "'",
            'post_id' => Schema::TYPE_INTEGER,
            'author_id' => Schema::TYPE_INTEGER
        ], $tableOptions);

        $this->createIndex('FK_comment_author', '{{%comment}}', 'author_id');
        $this->addForeignKey(
            'FK_comment_author', '{{%comment}}', 'author_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_comment_post', '{{%comment}}', 'post_id');
        $this->addForeignKey(
            'FK_comment_post', '{{%comment}}', 'post_id', '{{%post}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}
