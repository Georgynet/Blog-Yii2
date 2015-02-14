<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 13.12.14
 * Time: 18:21
 */

use common\models\Comment;

return [
    [
        'title' => 'Comment 1',
        'content' => 'Content 1',
        'publish_status' => Comment::STATUS_MODERATE,
        'post_id' => 1,
        'author_id' => 1,
    ],
    [
        'title' => 'Comment 1',
        'content' => 'Content 1',
        'publish_status' => Comment::STATUS_PUBLISH,
        'post_id' => 2,
        'author_id' => 1,
    ],
    [
        'title' => 'Comment 2',
        'content' => 'Content 2',
        'publish_status' => Comment::STATUS_PUBLISH,
        'post_id' => 2,
        'author_id' => 1,
    ],
    [
        'title' => 'Comment 3',
        'content' => 'Content 3',
        'publish_status' => Comment::STATUS_MODERATE,
        'post_id' => 2,
        'author_id' => 1,
    ]
];
