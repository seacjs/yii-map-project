<?php

namespace app\models;

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

    /* Todo: сделать разные названия в зависимости от культуры, а так же общие названия*/

    public function getNames() {
        return [
//            Yii::t('title', 'Peasant'),
//            Yii::t('title', 'Aristocrat'),
//            Yii::t('title', 'Graf'),
//            Yii::t('title', 'Duke'),
//            Yii::t('title', 'King'),
//            Yii::t('title', 'Emperor'),
        ];
    }

    public function getName() {

    }

    public $name;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

}
