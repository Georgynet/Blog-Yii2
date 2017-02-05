<?php

use common\models\Category;
use common\models\Post;
use common\models\User;
use yii\db\Migration;

class m141018_161427_18102014 extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(Category::tableName(), [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable(Post::tableName(), [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'anons' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'category_id' => $this->integer(),
            'author_id' => $this->integer(),
            'publish_status' => "enum('" . Post::STATUS_DRAFT . "','" . Post::STATUS_PUBLISH . "') NOT NULL DEFAULT '" . Post::STATUS_DRAFT . "'",
            'publish_date' => $this->timestamp()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_post_author', Post::tableName(), 'author_id');
        $this->addForeignKey(
            'FK_post_author', Post::tableName(), 'author_id', User::tableName(), 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_post_category', Post::tableName(), 'category_id');
        $this->addForeignKey(
            'FK_post_category', Post::tableName(), 'category_id', Category::tableName(), 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(Post::tableName());
        $this->dropTable(Category::tableName());
    }
}
