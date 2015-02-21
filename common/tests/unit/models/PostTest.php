<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 14.12.14
 * Time: 3:32
 */

namespace common\tests\unit\models;

use Codeception\Specify;
use common\models\Comment;
use common\models\Post;
use common\tests\fixtures\CategoryFixture;
use common\tests\fixtures\PostFixture;
use common\tests\fixtures\TagsFixture;
use common\tests\fixtures\UserFixture;
use common\tests\unit\DbTestCase;

class PostTest extends DbTestCase
{
    use Specify;

    /**
     * @var Post $postModel
     */
    private $postModel;

    public function setUp()
    {
        $this->postModel = new Post();

        parent::setUp();
    }

    public function testGetAuthor()
    {
        $post = $this->postModel->findOne(2);
        $this->assertInstanceOf('common\models\User', $post->getAuthor()->one());
    }

    public function testGetCategory()
    {
        $post = $this->postModel->findOne(2);
        $this->assertInstanceOf('common\models\Category', $post->getCategory()->one());
    }

    public function testGetComments()
    {
        $post = $this->postModel->findOne(2);
        foreach ($post->getComments()->all() as $comment) {
            $this->assertInstanceOf('common\models\Comment', $comment);
        }
    }

    public function testGetPublishedComments()
    {
        $post = $this->postModel->findOne(2);
        /** @var Comment $comment */
        foreach ($post->getPublishedComments()->models as $comment) {
            $this->assertEquals(Comment::STATUS_PUBLISH, $comment->publish_status);
        }
    }

    public function testGetPublishedPostSuccess()
    {
        $post = $this->postModel->getPost(2);
        $this->assertInstanceOf('common\models\Post', $post);
    }

    /**
     * @expectedException \yii\web\NotFoundHttpException
     */
    public function testGetPublishedPostFail()
    {
        $this->postModel->getPost(1);
    }

    public function testGetPublishedPosts()
    {
        $posts = $this->postModel->getPublishedPosts();

        $this->assertInstanceOf('yii\data\ActiveDataProvider', $posts);

        $count = $this->postModel->findAll([
            'publish_status' => Post::STATUS_PUBLISH
        ]);

        $this->assertEquals($posts->count, count($count));
    }

    public function testSetTags()
    {
        $sourceTags = [1, 3];

        $post = $this->postModel->findOne(2);
        $post->setTags($sourceTags);

        $this->assertInstanceOf('common\models\Post', $post);
        $this->assertTrue($post->save(false));

        $this->assertEquals($sourceTags, $post->getTags());
    }

    public function fixtures()
    {
        return [
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/post.php'
            ],
            'tags' => [
                'class' => TagsFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/tags.php'
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/category.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/user.php'
            ],
        ];
    }
}