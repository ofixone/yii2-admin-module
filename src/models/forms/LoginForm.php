<?php

namespace ofixone\admin\models\forms;

use ofixone\admin\interfaces\AdminInterface;
use ofixone\admin\Module;
use Yii;
use yii\base\Model;
use app\models\User;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = true;

    public $user = false;

    const REMEMBER_ME_TIME = 604800;

    public function rules()
    {
        return [
            [['login', 'password'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['login', 'password'], 'string', 'max' => 32, 'message' => 'Поле не может быть длинее 32 символов'],
            [['rememberMe'], 'boolean'],
            ['password', 'validatePassword'],

            [['login', 'password'], 'trim']
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    /**
     * @return bool
     */
    public function login()
    {
        if (!$this->validate()) {
            return false;
        }
        $duration = $this->rememberMe ? self::REMEMBER_ME_TIME : 0;
        if (Yii::$app->user->login($this->getUser(), $duration)) {
            return true;
        }

        return false;
    }

    /**
     * @return array|bool|null|ActiveRecord|AdminInterface
     */
    public function getUser()
    {
        if ($this->user === false) {
            /**
             * @var Module $module
             */
            $module = Yii::$app->controller->module;
            $modelClass = $module->adminModel;
            $this->user = $modelClass::find()
                ->andWhere([
                    'or',
                    ['login' => $this->login],
                ])
                ->one();
        }

        return $this->user;
    }

    /**
     * @return null
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError('login', 'Пользователя с таким логином или телефоном не существует');
            } else if (!Yii::$app->security->validatePassword($this->password, $user->getPasswordHash())) {
                $this->addError('password', 'Неправильный пароль');
            }
        }
    }
}