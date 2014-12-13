<?php

namespace frontend\controllers;

use common\models\Category;
use frontend\models\CommentForm;
use Yii;
use common\models\Post;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Контролеры "Постов".
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Список постов.
     * @return string
     */
    public function actionIndex()
    {
        $post = new Post();
        $category = new Category();

        return $this->render('index', [
            'posts' => $post->getPublishedPosts(),
            'categories' => $category->getCategories()
        ]);
    }

    /**
     * Просмотр поста.
     * @param string $id идентификатор поста
     * @return string
     */
    public function actionView($id)
    {
        $post = new Post();
        return $this->render('view', [
            'model' => $post->getPost($id),
            'commentForm' => new CommentForm(Url::to(['comment/add', 'id' => $id])),
        ]);
    }
}
