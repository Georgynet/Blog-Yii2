<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 13.12.14
 * Time: 23:37
 */

namespace frontend\controllers;

use common\models\Comment;
use frontend\models\CommentForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\User;

class CommentController extends Controller
{
    /**
     * @return string|Response
     */
    public function actionAdd()
    {
        $comment = new Comment();

        $commentForm = new CommentForm(Url::to(['comment/add', 'id' => Yii::$app->request->get('id')]));
        $comment->post_id = Yii::$app->request->get('id');

        if (Yii::$app->user instanceof User) {
            $comment->author_id = Yii::$app->user->getIdentity()->getId();
        }

        if ($commentForm->save($comment, Yii::$app->request->post('CommentForm'))) {
            return $this->redirect(['post/view', 'id' => Yii::$app->request->get('id')]);
        }

        return $this->render('create', [
            'model' => $commentForm
        ]);
    }
}