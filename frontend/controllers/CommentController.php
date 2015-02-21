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

/**
 * Контроллер "Комментарий".
 */
class CommentController extends Controller
{
    public function actionAdd()
    {
        $model = new Comment();

        $commentForm = new CommentForm(Url::to(['comment/add', 'id' => Yii::$app->request->get('id')]));
        $model->post_id = Yii::$app->request->get('id');

        if ($commentForm->save($model, Yii::$app->request->post('CommentForm'))) {
            return $this->redirect(['post/view', 'id' => Yii::$app->request->get('id')]);
        } else {
            return $this->render('create', [
                'model' => $commentForm
            ]);
        }
    }
}