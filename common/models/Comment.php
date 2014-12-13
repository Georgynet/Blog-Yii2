<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Модель комментариев.
 *
 * @property integer $id
 * @property integer $pid идентификатор родительского комментария
 * @property string $title заголовок
 * @property string $content комментарий
 * @property string $publish_status статус публикации
 * @property integer $post_id идентификатор поста, к которому относится комментарий
 * @property integer $author_id идентификатор автора комментария
 *
 * @property Post $post
 * @property User $author
 */
class Comment extends ActiveRecord
{
    /**
     * Статус комментария "На модерации"
     */
    const STATUS_MODERATE = 'moderate';
    /**
     * Статус комментария "Опубликован"
     */
    const STATUS_PUBLISH = 'publish';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'post_id', 'author_id'], 'integer'],
            [['title', 'content'], 'required'],
            [['publish_status'], 'string'],
            [['title', 'content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'title' => 'Title',
            'content' => 'Content',
            'publish_status' => 'Publish status',
            'post_id' => 'Post ID',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Возвращает комментарий.
     * @param int $id идентификатор комментария
     * @throws NotFoundHttpException
     * @return Comment
     */
    public function getComment($id)
    {
        if (
            ($model = Comment::findOne($id)) !== null &&
            $model->isPublished()
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist.');
        }
    }

    /**
     * Опубликован ли комментарий.
     * @return bool
     */
    protected function isPublished()
    {
        return $this->publish_status === self::STATUS_PUBLISH;
    }
}
