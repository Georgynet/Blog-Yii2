<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 21.02.15
 * Time: 20:52
 */

namespace common\tests\unit\models;

use common\models\Category;
use common\models\Post;
use common\tests\fixtures\PostFixture;
use common\tests\unit\DbTestCase;
use yii\db\ActiveRecord;
use yii\db\Command;

class CategoryTest extends DbTestCase
{
    /** @var Category $categoryModel */
    private $categoryModel;
    /** @var Post $postModel */
    private $postModel;

    public function setUp()
    {
        $this->categoryModel = new Category();
        $this->postModel = new Post();

        parent::setUp();
    }

    public function testGetPostsWithoutCategory()
    {
        $expectedPosts = $this->categoryModel->getPosts();

        $actualPosts = $this->postModel->findAll([
            'category_id' => NULL,
            'publish_status' => Post::STATUS_PUBLISH
        ]);

        $this->assertEquals($expectedPosts->count, count($actualPosts));
    }

    public function testGetPostsWithCategory()
    {
        $category = $this->categoryModel->findOne(1);
        $expectedPosts = $category->getPosts();

        $actualPosts = $this->postModel->findAll([
            'category_id' => 1,
            'publish_status' => Post::STATUS_PUBLISH
        ]);

        $this->assertEquals($expectedPosts->count, count($actualPosts));
    }

    public function testGetCategories()
    {
        $categories = $this->categoryModel->getCategories();

        foreach($categories->models as $category) {
            $this->assertInstanceOf('common\models\Category', $category);
        }
    }

    public function testGetCategorySuccess()
    {
        $this->assertInstanceOf(
            'common\models\Category',
            $this->categoryModel->getCategory(1)
        );
    }

    /**
     * @expectedException \yii\web\NotFoundHttpException
     */
    public function testGetCategoryNotFound()
    {
        $this->assertInstanceOf(
            'common\models\Category',
            $this->categoryModel->getCategory(-1)
        );
    }

    public function fixtures()
    {
        return [
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/post.php'
            ]
        ];
    }
}
