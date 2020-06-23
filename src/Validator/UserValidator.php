<?php

namespace Castels\Validator;

use Castels\Core\Validator;
use Castels\Entity\UserEntity;

class UserValidator extends Validator
{
    // массив значений формы
    private $user = [];

    public function __construct(UserEntity $user)
    {
        $this->user = $user;
    }

    public function validate(): array
    {
        $user = $this->user;

        if (!$user->login)
            $this->addError('Имя не может быть пустым!');


        $nameLen = mb_strlen($user->login);
        if ($nameLen < 5 or $nameLen > 60) {
            $this->addError('Длина имени не может превышать 60 или быть менне 5 символов!');
        }

        $login = $this->model->getName();
        if ( $login != $user->login ) {
            $this->addError('Такого логина нет в базе!');
        }

        $password = $this->model->getPassword();
        if( $password != $user->password ) {
            $this->addError('Пароль неправильный!');
        }

        if (!$user->password) {
            $this->addError('Пароль не может быть пустым!');
        }

        $passwordLen = mb_strlen($user->password);
        if ($passwordLen < 5 or $passwordLen > 16) {
            $this->addError('Длина пароля не может превышать 16 или быть менне 8 символов!');
        }


        return $this->errors;
    }

}