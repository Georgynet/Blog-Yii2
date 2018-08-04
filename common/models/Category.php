<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Category model.
 *
 * @property string $id
 * @property string $title
 * @property Post[] $posts
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%category}}';
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
     * Return posts for a category
     *
     * @return ActiveDataProvider
     */
    public function getPosts(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where([
                    'category_id' => $this->id,
                    'publish_status' => Post::STATUS_PUBLISH
                ])
        ]);
    }

    /**
     * Return category list
     *
     * @return ActiveDataProvider
     */
    public static function findCategories(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Category::find(),
            'pagination' => false
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public static function findById(int $id): Category
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested post does not exist.');
    }
}
