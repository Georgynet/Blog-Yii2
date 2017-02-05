<?php

use common\models\Comment;
use common\models\Post;
use common\models\User;
use yii\db\Migration;

class m141213_134307_comments extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(Comment::tableName(), [
            'id' => $this->primaryKey(),
            'pid' => $this->integer(),
            'title' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'publish_status' => "enum('" . Comment::STATUS_MODERATE . "','" . Comment::STATUS_PUBLISH . "') NOT NULL DEFAULT '" . Comment::STATUS_MODERATE . "'",
            'post_id' => $this->integer(),
            'author_id' => $this->integer()
        ], $tableOptions);

        $this->createIndex('FK_comment_author', Comment::tableName(), 'author_id');
        $this->addForeignKey(
            'FK_comment_author', Comment::tableName(), 'author_id', User::tableName(), 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_comment_post', Comment::tableName(), 'post_id');
        $this->addForeignKey(
            'FK_comment_post', Comment::tableName(), 'post_id', Post::tableName(), 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(Comment::tableName());
    }
}
