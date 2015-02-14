<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 13.12.14
 * Time: 18:30
 */

use common\models\Post;

return [
    [
        'title' => 'Post 1',
        'content' => 'Content 1'
    ],
    [
        'title' => 'Post 1',
        'anons' => 'anons 1',
        'content' => 'Content 1',
        'publish_status' => Post::STATUS_PUBLISH,
        'category_id' => 1,
        'author_id' => 1
    ]
];