<?php

use common\models\Post;
use common\models\TagPost;
use common\models\Tag;
use yii\db\Migration;

class m141116_104920_tags extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(Tag::tableName(), [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable(TagPost::tableName(), [
            'tag_id' => $this->integer(),
            'post_id' => $this->integer()
        ], $tableOptions);

        $this->createIndex('FK_tag', TagPost::tableName(), 'tag_id');
        $this->addForeignKey(
            'FK_tag_post', TagPost::tableName(), 'tag_id', Tag::tableName(), 'id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_post', TagPost::tableName(), 'post_id');
        $this->addForeignKey(
            'FK_post_tag', TagPost::tableName(), 'post_id', Post::tableName(), 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('FK_tag_post', TagPost::tableName());
        $this->dropForeignKey('FK_post_tag', TagPost::tableName());

        $this->dropTable(Tag::tableName());
        $this->dropTable(TagPost::tableName());
    }
}
