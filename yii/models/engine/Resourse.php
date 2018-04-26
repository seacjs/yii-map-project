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
class Resourse extends Model
{

    public function getAll() {
        return [
            'gold' => [
                'type' => '',
            ],
            'wood',
            'stone',
            'iron',
            'meat',
            'fish',
        ];
    }


    public $username;
    public $password;
    public $rememberMe = true;
}

