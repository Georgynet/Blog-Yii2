<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Post model.
 *
 * @property string $id
 * @property string $title
 * @property string $anons
 * @property string $content
 * @property string $category_id
 * @property string $author_id
 * @property string $publish_status
 * @property string $publish_date
 *
 * @property User $author
 * @property Category $category
 * @property Comment[] $comments
 */
class Post extends ActiveRecord
{
    public const STATUS_PUBLISH = 'publish';
    public const STATUS_DRAFT = 'draft';

    /**
     * Tag list
     * @var array
     */
    protected $tags = [];

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
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
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'anons' => Yii::t('backend', 'Announce'),
            'content' => Yii::t('backend', 'Content'),
            'category' => Yii::t('backend', 'Category'),
            'tags' => Yii::t('backend', 'Tags'),
            'category_id' => Yii::t('backend', 'Category ID'),
            'author' => Yii::t('backend', 'Author'),
            'author_id' => Yii::t('backend', 'Author ID'),
            'publish_status' => Yii::t('backend', 'Publish status'),
            'publish_date' => Yii::t('backend', 'Publish date'),
        ];
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    public function getPublishedComments(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getComments()
                ->where(['publish_status' => Comment::STATUS_PUBLISH])
        ]);
    }

    public function setTags(array $tagsId): void
    {
        $this->tags = $tagsId;
    }

    /**
     * Return tag ids
     */
    public function getTags(): array
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }

    /**
     * Return tags for post
     *
     * @return ActiveQuery
     */
    public function getTagPost(): ActiveQuery
    {
        return $this->hasMany(
            TagPost::class, ['post_id' => 'id']
        );
    }

    public static function findPublished(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public static function findById(int $id, bool $ignorePublishStatus = false): Post
    {
        if (($model = Post::findOne($id)) !== null) {
            if ($model->isPublished() || $ignorePublishStatus) {
                return $model;
            }
        }

        throw new NotFoundHttpException('The requested post does not exist.');
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

    protected function isPublished(): bool
    {
        return $this->publish_status === self::STATUS_PUBLISH;
    }
}
