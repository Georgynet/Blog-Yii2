<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 24.06.15
 * Time: 17:30
 */

namespace frontend\controllers;

use common\models\Category;
use common\models\Tag;
use Yii;
use yii\web\Controller;

class TagController extends Controller
{
    public function actionView($id)
    {
        $tag = Tag::findById($id);
        
        $posts = $tag->getPublishedPosts();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('view', [
            'tag' => $tag,
            'posts' => $posts,
            'categories' => Category::findCategories()
        ]);
    }
}
