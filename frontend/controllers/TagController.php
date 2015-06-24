<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 24.06.15
 * Time: 17:30
 */

namespace frontend\controllers;

use common\models\Category;
use common\models\Tags;
use yii\web\Controller;

/**
 * Контроллер "Тэги".
 */
class TagController extends Controller
{
    /**
     * Просмотр списка постов по тегу
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $tagModel = new Tags();
        $tag = $tagModel->getTag($id);
        $categoryModel = new Category();

        return $this->render('view', [
            'tag' => $tag,
            'posts' => $tag->getTagPosts(),
            'categories' => $categoryModel->getCategories()
        ]);
    }
}