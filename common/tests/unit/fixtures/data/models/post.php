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
    ],
    [
        'title' => 'Post 2',
        'anons' => 'anons 2',
        'content' => 'Content 2',
        'publish_status' => Post::STATUS_PUBLISH,
        'category_id' => 1,
        'author_id' => 1
    ],
    [
        'title' => 'Post 3',
        'anons' => 'anons 3',
        'content' => 'Content 3',
        'publish_status' => Post::STATUS_PUBLISH,
        'category_id' => 2,
        'author_id' => 1
    ],
    [
        'title' => 'Post 4',
        'anons' => 'anons 4',
        'content' => 'Content 4',
        'publish_status' => Post::STATUS_PUBLISH,
        'author_id' => 1
    ],
    [
        'title' => 'Post 5',
        'anons' => 'anons 5',
        'content' => 'Content 5',
        'publish_status' => Post::STATUS_PUBLISH,
        'author_id' => 1
    ]
];