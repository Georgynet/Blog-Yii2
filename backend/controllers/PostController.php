<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Tag;
use common\models\User;
use Yii;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class PostController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => Post::findById($id, true),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->author_id = Yii::$app->user->id;
        return $this->render('create', [
            'model' => $model,
            'category' => Category::find()->all(),
            'tags' => Tag::find()->all(),
            'authors' => User::find()->all()
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionUpdate(int $id)
    {
        $post = Post::findById($id, true);

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->redirect(['view', 'id' => $post->id]);
        }

        return $this->render('update', [
            'model' => $post,
            'authors' => User::find()->all(),
            'tags' => Tag::find()->all(),
            'category' => Category::find()->all()
        ]);
    }

    public function actionDelete(int $id): Response
    {
        Post::findById($id, true)->delete();

        return $this->redirect(['index']);
    }
}
