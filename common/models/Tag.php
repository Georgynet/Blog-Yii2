<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Tag model.
 *
 * @property int $id
 * @property string $title
 *
 * @property TagPost[] $tagPosts
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
        ];
    }

    /**
     * Return posts for tag
     * @return ActiveQuery
     */
    public function getTagPosts(): ActiveQuery
    {
        return $this->hasMany(TagPost::class, ['tag_id' => 'id']);
    }

    /**
     * @return ActiveDataProvider
     */
    public function getPublishedPosts(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getTagPosts()
                ->alias('tp')
                ->leftJoin(Post::tableName() . ' p', 'p.id = tp.post_id')
                ->where(['publish_status' => Post::STATUS_PUBLISH])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public static function findById(int $id): Tag
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested post does not exist.');
    }
}
