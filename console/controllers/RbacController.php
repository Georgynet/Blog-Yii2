<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 07.03.16
 * Time: 15:01
 */

namespace console\controllers;

use console\models\UserRoleRule;
use yii\console\Controller;

/**
 * Контроллер права доступа.
 */
class RbacController extends Controller
{
    /**
     * Формирование прав доступа
     */
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $rule = new UserRoleRule();
        $auth->add($rule);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $auth->addChild($admin, $user);
    }
}
