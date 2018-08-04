<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 2:03
 */

namespace frontend\controllers;

use common\models\Category;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionView(int $id): string
    {
        $category = Category::findById($id);

        $posts = $category->getPosts();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('index', [
            'category' => $category,
            'posts' => $posts,
            'categories' => Category::findCategories()
        ]);
    }
} 