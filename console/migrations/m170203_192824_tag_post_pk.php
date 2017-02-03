<?php

use common\models\TagPost;
use yii\db\Migration;

class m170203_192824_tag_post_pk extends Migration
{
    public function up()
    {
        $this->addColumn(TagPost::tableName(), 'id', $this->primaryKey()->first());
    }

    public function down()
    {
        $this->dropColumn(TagPost::tableName(), 'id');
    }
}
