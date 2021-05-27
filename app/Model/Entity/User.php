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
     * Método responsável por cadastrar um usuário no banco 
     * @return boolean
     */
    public function cadastrar(){
        $this->id = (new Database('usuarios'))->insert([
            'nome'=>$this->nome,
            'email'=>$this->email,
            'senha'=>$this->senha
        ]);

        return true;
    }

    /**
     * Método responsável por atualizar um usuário no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('usuarios'))->update('id='.$this->id,[
            'nome'=>$this->nome,
            'email'=>$this->email,
            'senha'=>$this->senha
        ]);
    }

    /**
     * Método responsável por excluir um registro
     * @return PDOStatment
     */
    public function excluir(){
        return (new Database('usuarios'))->delete('id='.$this->id);
    }

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
     * Método responsável por buscar um usuário pelo id
     * @return User
     */
    public static function getUserById($id){
        return (new Database('usuarios'))->select('id='.$id)
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