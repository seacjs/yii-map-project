<?php

namespace app\models\engine;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Title extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
}

