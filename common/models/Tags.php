<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Модель тэгов.
 *
 * @property integer $id
 * @property string $title название тэга
 *
 * @property TagPost[] $tagPosts
 */
class Tags extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
        ];
    }

    /**
     * Возвращает посты, относящиеся к тегу.
     * @return ActiveQuery
     */
    public function getTagPosts()
    {
        return $this->hasMany(TagPost::className(), ['tag_id' => 'id']);
    }

    /**
     * Возвращает опубликованные посты, связанные с тэгом.
     * @return ActiveDataProvider
     */
    public function getPublishedPosts()
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
     * Возвращает модель тэга.
     * @param int $id
     * @return Tags
     * @throws NotFoundHttpException
     */
    public function getTag($id)
    {
        if (($model = Tags::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist.');
        }
    }
}
