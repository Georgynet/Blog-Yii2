<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /** @var \common\models\User */
    private $user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \InvalidArgumentException if token is empty or not valid
     */
    public function __construct(string $token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new \InvalidArgumentException('Password reset token cannot be blank.');
        }

        $this->user = User::findByPasswordResetToken($token);

        if (!$this->user) {
            throw new \InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function resetPassword(): bool
    {
        $user = $this->user;
        $user->password = $this->password;
        $user->removePasswordResetToken();

        return $user->save();
    }
}
