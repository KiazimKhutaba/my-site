<?php


namespace Castels\Model;


use Castels\Core\BaseModel;
use Castels\Entity\UserEntity;
use PDO;

class UserModel extends BaseModel
{
    /**
     * @var PDO
     */
    private $pdo;


    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function makeUser(array $request)
    {
        $user = new UserEntity();

        $user->login    = $request['login']    ?? '';
        $user->password = $request['password'] ?? '';
        $this->trim($user);

        return $user;
    }


    public function getName() {
        return "admin";
    }

    public function getPassword() {
        return "qwerty";
    }

}