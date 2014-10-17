<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 2:03
 */

namespace frontend\controllers;

use common\models\Category;
use yii\web\Controller;

/**
 * Контроллеры "Категорий".
 */
class CategoryController extends Controller
{
    public function actionIndex($id)
    {
        echo '1';
        $category = new Category();

        return $this->render('index', [
            'category' => $category->getCategory($id),
            'posts' => $category->getPosts($id),
            'categories' => $category->getCategories()
        ]);
    }
} 