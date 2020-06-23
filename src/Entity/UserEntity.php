<?php


namespace Castels\Entity;


class UserEntity
{
    /** @var int */
    public $id;

    /** @var string */
    public $login;

    /** @var string */
    public $password;

    /** @var string */
    public $email;

    /** @var int */
    public $ip;

    /** @var int */
    public $last_login;

}