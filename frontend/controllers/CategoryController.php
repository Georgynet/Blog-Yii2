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
use yii\web\NotFoundHttpException;

/**
 * Контроллеры "Категорий".
 */
class CategoryController extends Controller
{
    public function actionIndex($id)
    {
        $categoryModel = new Category();
        $category = $categoryModel->getCategory($id);

        return $this->render('index', [
            'category' => $categoryModel->getCategory($id),
            'posts' => $category->getPosts(),
            'categories' => $categoryModel->getCategories()
        ]);
    }
} 