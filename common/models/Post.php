<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Модель постов.
 *
 * @property string $id
 * @property string $title заголовок
 * @property string $anons анонс
 * @property string $content контент
 * @property string $category_id категория
 * @property string $author_id автор
 * @property string $publish_status статус публикации
 * @property string $publish_date дата публикации
 *
 * @property User $author
 * @property Category $category
 * @property Comment[] $comments
 */
class Post extends ActiveRecord
{
    /**
     * Статус поста: опубликованн.
     */
    const STATUS_PUBLISH = 'publish';
    /**
     * Статус поста: черновие.
     */
    const STATUS_DRAFT = 'draft';

    /**
     * Список тэгов, закреплённых за постом.
     * @var array
     */
    protected $tags = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['category_id', 'author_id'], 'integer'],
            [['anons', 'content', 'publish_status'], 'string'],
            [['publish_date', 'tags'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'anons' => 'Анонс',
            'content' => 'Контент',
            'category' => 'Категория',
            'tags' => 'Тэги',
            'category_id' => 'Категория',
            'author' => 'Автор',
            'author_id' => 'Автор',
            'publish_status' => 'Статус публикации',
            'publish_date' => 'Дата публикации',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * Возвращает опубликованные комментарии
     * @return ActiveDataProvider
     */
    public function getPublishedComments()
    {
        return new ActiveDataProvider([
            'query' => $this->getComments()
                ->where(['publish_status' => Comment::STATUS_PUBLISH])
        ]);
    }

    /**
     * Устанавлиает тэги поста.
     * @param $tagsId
     */
    public function setTags($tagsId)
    {
        $this->tags = (array) $tagsId;
    }

    /**
     * Возвращает массив идентификаторов тэгов.
     */
    public function getTags()
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }

    /**
     * Возвращает тэги поста.
     * @return ActiveQuery
     */
    public function getTagPost()
    {
        return $this->hasMany(
            TagPost::className(), ['post_id' => 'id']
        );
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    public function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }

    /**
     * Возвращает модель поста.
     * @param int $id
     * @throws NotFoundHttpException в случае, когда пост не найден или не опубликован
     * @return Post
     */
    public function getPost($id)
    {
        if (
            ($model = Post::findOne($id)) !== null &&
            $model->isPublished()
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist.');
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        TagPost::deleteAll(['post_id' => $this->id]);

        if (is_array($this->tags) && !empty($this->tags)) {
            $values = [];
            foreach ($this->tags as $id) {
                $values[] = [$this->id, $id];
            }
            self::getDb()->createCommand()
                ->batchInsert(TagPost::tableName(), ['post_id', 'tag_id'], $values)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Опубликован ли пост.
     * @return bool
     */
    protected function isPublished()
    {
        return $this->publish_status === self::STATUS_PUBLISH;
    }
}
