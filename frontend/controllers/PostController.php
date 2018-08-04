<?php

namespace frontend\controllers;

use common\models\Category;
use frontend\models\CommentForm;
use Yii;
use common\models\Post;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

class PostController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $posts = Post::findPublished();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('index', [
            'posts' => $posts,
            'categories' => Category::findCategories()
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => Post::findById($id),
            'commentForm' => new CommentForm(Url::to(['comment/add', 'id' => $id])),
        ]);
    }
}
