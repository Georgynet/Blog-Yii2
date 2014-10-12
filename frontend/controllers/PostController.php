<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Вывод списка "Постов".
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

        return $this->render('index', [
            'dataProvider' => $post->getPublishedPosts(),
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
        ]);
    }
}
