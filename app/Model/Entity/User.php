<?php

namespace App\Model\Entity;

use App\Database\Database;
use \PDO;

class User
{
    /**
     * ID do usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário 
     * @var string
     */
    public $nome;

    /**
     * E-mail do usuário 
     * @var string
     */
    public $email;

    /**
     * Senha do usuário
     * @var string 
     */
    public $senha;

    /**
     * Método responsável por retornar um usuário com base em seu E-mail
     * @param string $email
     * @return User
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select("email='".$email."'")
                                        ->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar uma pesquisa 
     * @return PDOStatement
     */
    public static function getUsers($where = null, $order = null, $limit = null, $field = '*'){
        return (new Database('usuarios'))->select($where,$order,$limit,$field);
    }
}