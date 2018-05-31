<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property UserIdentity|null $user This property is read-only.
 *
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $confirmPassword;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'confirmPassword'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой логин уже занят' ],
            ['confirmPassword', 'confirmValidation'],
        ];
    }

    public function confirmValidation($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->confirmPassword) {
                $this->addError($attribute, 'Повторный пароль введен неверно.');
            }
        }
    }

    /**
     * Registration new User
     * @return bool
     */
    public function registration()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->access_token = Yii::$app->security->generateRandomString();
            Yii::$app->mailer->compose('registration', ['token' => $user->access_token])
                ->setFrom(['antonovsasha22@gmail.com' => 'eshop'])
                ->setTo($this->username)
                ->setSubject('Регистрация на сайте Eshop')
                ->send();
            return $user->save();
        }
        return false;
    }

    public function sendMail()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = $this->password;
            return $user->save();
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'confirmPassword' => 'Повторите пароль'
        ];
    }
}
