<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Bridge collection tag-post.
 *
 * @property int $tag_id
 * @property int $post_id
 *
 * @property Post $post
 * @property Tag $tag
 */
class TagPost extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%tag_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['tag_id', 'post_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'tag_id' => Yii::t('backend', 'Tag ID'),
            'post_id' => Yii::t('backend', 'Post ID'),
        ];
    }

    public function getPost(): ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function getTag(): ActiveQuery
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }
}
