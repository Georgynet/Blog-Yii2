<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель категорий.
 *
 * @property string $id
 * @property string $title заголовок
 * @property Post[] $posts посты, относящиеся к категории
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            'id' => 'ID',
            'title' => 'Заголовок',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    /**
     * Возвращает список категорий
     * @return ActiveDataProvider
     */
    public function getCategories()
    {
        return new ActiveDataProvider([
            'query' => Category::find()
        ]);
    }
}
