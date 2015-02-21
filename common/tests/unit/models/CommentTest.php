<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 13.12.14
 * Time: 19:50
 */

namespace common\tests\unit\models;

use Codeception\Specify;
use common\models\Comment;
use common\tests\fixtures\CommentFixture;
use common\tests\fixtures\PostFixture;
use common\tests\unit\DbTestCase;
use Yii;
use yii\web\NotFoundHttpException;

class CommentTest extends DbTestCase
{
    use Specify;

    /** @var Comment $commentModel */
    private $commentModel;

    public function setUp()
    {
        parent::setUp();

        $this->commentModel = new Comment();
    }

    public function testGetComment()
    {
        $comment = $this->commentModel->getComment(2);
        $this->assertInstanceOf('common\models\Comment', $comment);
    }

    /**
     * @expectedException NotFoundHttpException
     */
    public function testGetCommentNotFound()
    {
        $this->setExpectedException('yii\web\NotFoundHttpException');
        $this->commentModel->getComment(1);
        $this->commentModel->getComment(10000000);
    }

    public function testGetPostByComment()
    {
        $comment = $this->commentModel->getComment(2);
        $this->assertInstanceOf('common\models\Post', $comment->getPost()->one());
    }

    public function testGetAuthorByComment()
    {
        $comment = $this->commentModel->getComment(2);
        $this->assertInstanceOf('common\models\User', $comment->getAuthor()->one());
    }

    public function fixtures()
    {
        return [
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/post.php'
            ],
            'comment' => [
                'class' => CommentFixture::className(),
                'dataFile' => '@common/tests/unit/fixtures/data/models/comment.php'
            ],
        ];
    }
}